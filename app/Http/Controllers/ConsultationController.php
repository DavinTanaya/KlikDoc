<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Helpers\PrescriptionPdfHelper;
use App\Models\Application;
use App\Models\Chat;
use App\Models\Consultation;
use App\Models\Drug;
use App\Models\Message;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Rating;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class ConsultationController extends Controller
{
    public function getConsultation(Request $request)
    {
        $query = Application::where('status', 'approved')
            ->where('is_active', true);

        $search = $request->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                ->orWhere('spesialisasi', 'like', "%$search%");
            });
        }

        $kategoriJson = $request->query('kategori_json');
        $selectedSpecs = $kategoriJson ? json_decode($kategoriJson, true) : [];
        if (!empty($selectedSpecs)) {
            $query->whereIn('spesialisasi', $selectedSpecs);
        }

        match ($request->query('filter')) {
            'pengalaman-terlama' => $query->orderByDesc('experience_years'),
            'pengalaman-terbaru' => $query->orderBy('experience_years'),
            'nama-a-z' => $query->orderBy('full_name'),
            'nama-z-a' => $query->orderByDesc('full_name'),
            default => null
        };

        $doctors = $query->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->paginate(8);

        $upcomingConsultations = Consultation::with('doctor')
            ->where('user_id', auth()->id())
            ->where('status', 'AKTIF')
            ->latest()
            ->take(1)
            ->get();

        $historyConsultations = Consultation::with('doctor')
            ->where('user_id', auth()->id())
            ->where('status', 'SELESAI')
            ->latest()
            ->take(3)
            ->get();

        $specializations = Application::where('status', 'approved')
            ->where('is_active', true)
            ->select('spesialisasi')->distinct()->pluck('spesialisasi');

        return view('user.layanan.konsultasi.dokter.index', compact(
            'doctors',
            'specializations',
            'selectedSpecs',
            'search',
            'upcomingConsultations',
            'historyConsultations'
        ));
    }

    public function getConsultationDetail($id){
        $doctor = Application::where('id', $id)
            ->where('status', 'approved')
            ->where('is_active', true)
            ->firstOrFail();
            
        $ratingAverage = $doctor->averageRating() ?? 0;
        $ratingCount = $doctor->ratings()->count();
        $base = 30000;
        $expFactor = 4000;

        $rating = $doctor->averageRating();
        $ratingBonus = max(0, ($rating - 4.0)) * 20000;

        $price = $base
            + ($doctor->experience_years * $expFactor)
            + $ratingBonus;

        return view('user.layanan.konsultasi.dokter.detail', [
            'doctor' => $doctor,
            'ratingAverage' => $ratingAverage,
            'ratingCount' => $ratingCount,
            'price' => $price
        ]);
    }

    public function payConsultation(Request $request, $id)
    {
        $user = auth()->user();

        $base = 30000;
        $expFactor = 4000;
        $doctor = Application::where('id', $id)
            ->where('status', 'approved')
            ->where('is_active', true)
            ->firstOrFail();
        $rating = $doctor->averageRating();
        $ratingBonus = max(0, ($rating - 4.0)) * 20000;

        $consultationFee = $base
            + ($doctor->experience_years * $expFactor)
            + $ratingBonus;

        $serviceFee  = 2000;
        $platformFee = 0;

        $total = $consultationFee + $serviceFee + $platformFee;

        $consultationCode = 'CONS-' . strtoupper(uniqid());

        $consultation = Consultation::create([
            'user_id'          => $user->id,
            'doctor_id'        => $doctor->id,
            'consultation_code'=> $consultationCode,
            'method'           => 'chat',
            'consultation_fee' => $consultationFee,
            'service_fee'      => $serviceFee,
            'platform_fee'     => $platformFee,
            'total'            => $total,
            'status'           => 'BELUM_BAYAR',
        ]);

        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $itemDetails = [
            [
                'id' => 'consultation_' . $doctor->id,
                'price' => $consultationFee,
                'quantity' => 1,
                'name' => 'Konsultasi Dokter - ' . $doctor->full_name,
            ],
            [
                'id' => 'service_fee',
                'price' => $serviceFee,
                'quantity' => 1,
                'name' => 'Biaya Layanan',
            ],
            [
                'id' => 'platform_fee',
                'price' => $platformFee,
                'quantity' => 1,
                'name' => 'Platform Fee',
            ],
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $consultation->consultation_code,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '08123456789',
            ],
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => route('konsultasi.success', $consultation->consultation_code),
            ]
        ];

        $snap = Snap::createTransaction($params);

        $consultation->update([
            'snap_token' => $snap->token
        ]);

        return redirect($snap->redirect_url);
    }

    public function paymentSuccess($code)
    {
        $consultation = Consultation::where('consultation_code', $code)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $consultation->update([
            'status' => 'AKTIF'
        ]);
        
        $doctor = Application::find($consultation->doctor_id);

        Chat::firstOrCreate([
            'user_id' => auth()->id(),
            'doctor_id' => $doctor->user_id,
            'consultation_id' => $consultation->id,
        ]);

        return view('user.layanan.konsultasi.payment.success', compact('consultation'));
    }

    /**
     * RETRY PAYMENT
     */
    public function retryPayment($code)
    {
        $consultation = Consultation::with('doctor')
            ->where('consultation_code', $code)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        $itemDetails = [
            [
                'id' => 'consultation_' . $consultation->doctor_id,
                'price' => $consultation->consultation_fee,
                'quantity' => 1,
                'name' => 'Konsultasi Dokter - ' . $consultation->doctor->full_name,
            ],
            [
                'id' => 'service_fee',
                'price' => $consultation->service_fee,
                'quantity' => 1,
                'name' => 'Biaya Layanan',
            ],
            [
                'id' => 'platform_fee',
                'price' => $consultation->platform_fee,
                'quantity' => 1,
                'name' => 'Platform Fee',
            ],
        ];

        $params = [
            'transaction_details' => [
                'order_id' => $consultation->consultation_code,
                'gross_amount' => $consultation->total,
            ],
            'customer_details' => [
                'first_name' => $consultation->user->name,
                'email' => $consultation->user->email,
            ],
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => route('konsultasi.success', $consultation->consultation_code),
            ]
        ];

        $snap = Snap::createTransaction($params);

        $consultation->update([
            'snap_token' => $snap->token
        ]);

        return redirect($snap->redirect_url);
    }

    public function getHistory(){
        $consultations = Consultation::where('user_id', auth()->id())
            ->when(request('status'), fn ($q) =>
                $q->where('status', request('status'))
            )
            ->latest()
            ->get();

        return view('user.layanan.konsultasi.history.index', [
            'consultations' => $consultations
        ]);
    }

    public function getDetail($id){
        $consultation = Consultation::with([
            'doctor',
            'prescriptions',
            'rating',
            'prescriptions.items.drug'
        ])
        ->where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

        return view(
            'user.layanan.konsultasi.history.detail',
            ['consultation' => $consultation]
        );
    }

    public function giveRating(Request $request, $id){
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $consultation = Consultation::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'SELESAI')
            ->firstOrFail();

        $existingRating = $consultation->rating;
        if ($existingRating) {
            return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk konsultasi ini.');
        }

        Rating::create([
            'user_id' => auth()->id(),
            'doctor_id' => $consultation->doctor_id,
            'consultation_id' => $consultation->id,
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
        ]);

        return redirect()->back()->with('success', 'Terima kasih telah memberikan rating!');
    }

    public function searchDrug(){
        $request = request();
        return Drug::where('name', 'like', "%{$request->q}%")
                ->limit(10)
                ->get(['id', 'name']);
    }

    public function createPrescriptionChat(Request $request, $consultationId)
    {
        $request->validate([
            'diagnosis' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.drug_id' => 'required|exists:drugs,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);
        $doctor = auth()->user();
        $doctorApplication = Application::where('user_id', $doctor->id)->firstOrFail();
        
        $consultation = Consultation::with('chat')
            ->where('id', $consultationId)
            ->where('doctor_id', $doctorApplication->id)
            ->where('status', 'AKTIF')
            ->firstOrFail();

        $prescription = null;
        DB::transaction(function () use ($request, $consultation, $doctor, &$prescription) {
            $prescription = Prescription::create([
                'consultation_id' => $consultation->id,
                'diagnosis' => $request->diagnosis,
                'notes' => $request->notes,
            ]);

            foreach ($request->items as $item) {
                PrescriptionItem::create([
                    'prescription_id' => $prescription->id,
                    'drug_id' => $item['drug_id'],
                    'qty' => $item['qty'],
                ]);
            }

            $message = Message::create([
                'chat_id'        => $consultation->chat->id,
                'sender_id'      => $doctor->id,
                'type'           => 'prescription',
                'prescription_id'=> $prescription->id,
                'body'           => 'Dokter telah mengirimkan resep.',
            ]);
            broadcast(new NewMessage($message))->toOthers();
        });

        return response()->json([
            'success' => true,
            'message' => 'Resep berhasil dikirim',
            'prescription_id' => $prescription->id
        ]);

    }

    public function finishConsultation(Request $request, $consultationId)
    {
        $doctor = auth()->user();
        $doctorApplication = Application::where('user_id', $doctor->id)->firstOrFail();
        $consultation = Consultation::where('id', $consultationId)
            ->where('doctor_id', $doctorApplication->id)
            ->where('status', 'AKTIF')
            ->firstOrFail();

        if($consultation->prescriptions()->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tolong tambahkan resep/diagnosa sebelum menyelesaikan konsultasi.'
            ], 400);
        }

        $consultation->update([
            'status' => 'SELESAI',
        ]);

        $chat = $consultation->chat;

        if ($chat) {
            $chat->update(['status' => 'closed']);

            $message = Message::create([
                'sender_id' => $doctor->id,
                'chat_id' => $chat->id,
                'type' => 'system',
                'body' => 'KONSULTASI_SELESAI'
            ]);

            broadcast(new NewMessage($message))->toOthers();
        }

        return response()->json(data: [
            'success' => true,
            'message' => 'Konsultasi telah diselesaikan.'
        ]);
    }
   public function download($id)
    {
        $prescription = Prescription::with(['consultation', 'items.drug', 'consultation.doctor', 'consultation.user', 'consultation.doctor'])
            ->findOrFail($id);
        // security (opsional tapi WAJIB dalam prod)
        // if (
        //     auth()->id() !== $prescription->user_id &&
        //     auth()->id() !== $prescription->doctor_id
        // ) {
        //     abort(403);
        // }

        return PrescriptionPdfHelper::download($prescription);
    }

}

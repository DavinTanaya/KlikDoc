<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Application;
use App\Models\Chat;
use App\Models\Consultation;
use App\Models\Message;
use App\Models\Referral;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctor = auth()->user();
        $doctorId = Application::where('user_id', $doctor->id)->firstOrFail()->id;

        $totalPasien = Consultation::where('doctor_id', $doctorId)
            ->distinct('user_id')
            ->count('user_id');

        $aktifConsultation = Consultation::where('doctor_id', $doctorId)
            ->where('status', 'AKTIF')
            ->count();

        $selesaiConsultation = Consultation::where('doctor_id', $doctorId)
            ->where('status', 'SELESAI')
            ->count();

        $activeChats = Chat::where('doctor_id', $doctor->id)
            ->whereHas('consultation', fn ($q) =>
                $q->where('status', 'AKTIF')
            )
            ->with(['user'])
            ->latest()
            ->take(5)
            ->get();

        return view('dokter.dashboard.index', compact(
            'totalPasien',
            'aktifConsultation',
            'selesaiConsultation',
            'activeChats'
        ));
    }
    public function registerIndex() {
        return view('dokter.pendaftaran.index');
    }
    public function register(Request $request){
        $request->validate([        
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'gender' => 'required|string|max:255|in:male,female',
            'str' => 'required|string|max:255',
            'sip' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,jpg,png|max:5120',
            'experience_years' => 'required|integer|min:0',
        ]);

        $document = $request->file('document');
        $document_name = now()->format('YmdHis') . '_' . $document->getClientOriginalName();
        $document->move(public_path('documents/applicants'), $document_name);
        
        Application::create([
            'user_id' => auth()->user()->id,
            'full_name' => $request->input('full_name'),
            'nik' => $request->input('nik'),
            'gender' => $request->input('gender'),
            'str' => $request->input('str'),
            'sip' => $request->input('sip'),
            'spesialisasi' => $request->input('spesialisasi'),
            'document' => $document_name,
            'experience_years' => $request->input('experience_years'),
        ]);

        return redirect()->route('home')->with('success', 'Application submitted successfully!');
    }

    public function getHistory(){
        $doctor = auth()->user();
        $doctorId = Application::where('user_id', $doctor->id)->firstOrFail()->id;
        $consultations = Consultation::with([
                'user',
                'prescriptions',
                'referral'
            ])
            ->where('doctor_id', $doctorId)
            ->where('status', 'SELESAI')
            ->latest()
            ->get();
            
        return view('dokter.layanan.history', compact('consultations'));
    }

    public function getRefferal(){
        $doctor = auth()->user();
        $doctorId = Application::where('user_id', $doctor->id)->firstOrFail()->id;
        $consultationsOnline = Consultation::with(['user'])
            ->where('doctor_id', $doctorId)
            ->where('status', 'AKTIF')
            ->whereDoesntHave('referral')
            ->orderBy('created_at', 'asc')
            ->get();

        $referrals = Referral::whereHas('consultation', function ($q) use ($doctorId) {
            $q->where('doctor_id', $doctorId);
        })
        ->with(['consultation.user'])
        ->latest()
        ->get();

        return view('dokter.layanan.rujukan', compact('consultationsOnline', 'referrals'));
    }

    public function storeRefferal(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'destination'     => 'required|string',
            'department'      => 'required|string',
            'reason'          => 'required|string',
            'notes'           => 'nullable|string',
        ]);

        $consultation = Consultation::with('chat')->findOrFail($request->consultation_id);

        $referral = Referral::updateOrCreate(
            ['consultation_id' => $consultation->id],
            [
                'destination' => $request->destination,
                'department'  => $request->department,
                'reason'      => $request->reason,
                'notes'       => $request->notes,
            ]
        );

        $message = Message::create([
            'chat_id'    => $consultation->chat->id,
            'sender_id'  => auth()->id(),
            'type'       => 'referral',
            'body'       => 'Dokter telah membuat surat rujukan.',
            'referral_id'=> $referral->id,
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return response()->json([
            'ok' => true,
            'message' => 'Rujukan berhasil dikirim ke pasien'
        ]);
    }

    public function downloadRefferal(Referral $referral)
    {
        // ✅ AMBIL RELASI YANG DIPERLUKAN
        $referral->load([
            'consultation.user',
            'consultation.doctor'
        ]);

        $consultation = $referral->consultation;

        // $user = auth()->user();

        // if (
        //     $user->role === 'user' &&
        //     $consultation->user_id !== $user->id
        // ) {
        //     abort(403, 'Tidak memiliki akses');
        // }

        // if (
        //     $user->role === 'doctor' &&
        //     $consultation->doctor_id !== $user->id
        // ) {
        //     abort(403, 'Tidak memiliki akses');
        // }

        // ✅ DATA UNTUK VIEW PDF
        $data = [
            'referral'      => $referral,
            'consultation'  => $consultation,
            'patient'       => $consultation->user,
            'doctor'        => $consultation->doctor,
            'doctorProfile' => $consultation->doctor,
            'date'          => now()->format('d F Y'),
        ];

        // ✅ GENERATE PDF
        $pdf = Pdf::loadView(
            'pdf.referral',
            $data
        )->setPaper('A4', 'portrait');

        // ✅ DOWNLOAD
        return $pdf->download(
            'Surat_Rujukan_' . $data['patient']->name . '.pdf'
        );
    }

    public function profile() {
        return view('dokter.profile.index');
    }

    public function update(Request $request){
        $user = auth()->user();

        if ($user->role !== 'doctor') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name'   => ['nullable', 'string', 'max:255'],
            'phone'  => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $doctor = $user->application;
        if (!$doctor) {
            return back()->with('error', 'Data Dokter tidak ditemukan.');
        }

        $applicationUpdate = [];
        $userUpdate = [];

        if (!empty($validated['name'])) {
            $applicationUpdate['full_name'] = $validated['name'];
        }

        if (!empty($validated['phone'])) {
            $userUpdate['phone_number'] = $validated['phone'];
        }

        if ($request->hasFile('avatar')) {
            if ($doctor->avatar && !str_contains($doctor->avatar, 'ui-avatars.com')) {
                $oldPath = public_path($doctor->avatar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $extension = $request->avatar->extension();
            $filename = 'dokter-profile_' . now() . '.' . $extension;
            $request->avatar->move(public_path('images/profile/dokter'), $filename);
            $applicationUpdate['avatar'] = 'images/profile/dokter/' . $filename;
        }

        if (!empty($applicationUpdate)) {
            $doctor->update($applicationUpdate);
        }

        if (!empty($userUpdate)) {
            $user->update($userUpdate);
        }

        if (empty($applicationUpdate) && empty($userUpdate)) {
            return back()->with('success', 'Tidak ada perubahan yang dilakukan.');
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}

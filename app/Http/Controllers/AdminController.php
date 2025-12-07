<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Article;
use App\Models\Consultation;
use App\Models\Drug;
use App\Models\KlikHomeOrder;
use App\Models\KlikHomeService;
use App\Models\Order;
use App\Models\Rating;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function getApotekHtml() {
        $latestOrders = Order::with('user')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
        $search = request('search');

        $drugs = Drug::when($search, function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%")
                ->orWhere('type', 'like', "%$search%");
            })
            ->orderBy('name')
            ->get();

        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', today())->count();
        return view('admin.pages.apotek', ['drugs' => $drugs, 'latestOrders' => $latestOrders, 'totalOrders' => $totalOrders, 'todayOrders' => $todayOrders])->render();
    }

    public function drugOrderDetail($code) {
        $order = Order::with(['items.drug', 'user', 'address'])
        ->where('order_code', $code)
        ->firstOrFail();
        return view('admin.pages.apotek.order_detail', ['order' => $order]);
    }

    public function updateOrder($code){
        $order = Order::where('order_code', $code)->firstOrFail();
        $order->status = request()->input('status');
        $order->save();

        return redirect()->route('admin.orders.detail', $order->order_code)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function drugOrderHistory() {
        $status = request()->query('status');
        if(in_array($status, ['BELUM_BAYAR', 'DIPROSES', 'SELESAI', 'DIBATALKAN'])) {
            $orders = Order::with(['items.drug', 'address.cityRelation', 'address.provinceRelation', 'user'])
                ->where('status', $status)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('admin.pages.order.order_history', compact('orders'));
        }
        $orders = Order::with(['items.drug', 'address.cityRelation', 'address.provinceRelation'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pages.apotek.order_history', compact('orders'));
    }

    public function getDokterHtml() {
        $search = request('search');
        $doctors = Application::whereIn('status', ['approved', 'disabled'])->when($search, function($q) use ($search) { 
            return $q->where('full_name', 'like', '%' . $search . '%')
                  ->where('status', 'approved');
        })->get();
        $latestApplicants = Application::orderBy('created_at', 'desc')->limit(5)->get();

        $totalDoctors = Application::where('status', 'approved')->get();
        $totalApplicants = Application::count();
        $rejectedApplicants = Application::where('status', 'rejected')->count();
        $acceptedApplicants = Application::where('status', 'approved')->count();
        $pendingApplicants = Application::where('status', 'pending')->count();
        $disabledApplicants = Application::where('status', 'disabled')->count();
        $averageRating = round(Rating::avg('rating'), 1);

        return view('admin.pages.doctor', ['doctors' => $doctors, 'latestApplicants' => $latestApplicants, 'totalDoctors' => $totalDoctors, 'totalApplicants' => $totalApplicants, 'rejectedApplicants' => $rejectedApplicants, 'acceptedApplicants' => $acceptedApplicants, 'pendingApplicants' => $pendingApplicants, 'disabledApplicants' => $disabledApplicants, 'averageRating' => $averageRating ])->render();
    }

    public function updateApplicationStatus($id) {
        $status = request('status');

        if (!in_array($status, ['pending','approved','rejected','disabled'])) {
            return back()->with('error', 'Status tidak valid!');
        }
        $application = Application::findOrFail($id);
        if($status === 'disabled'){
            $application->status = 'disabled';
            $application->is_active = false;
            $application->save();
            return redirect()->back()->with('success', 'Doctor has been disabled successfully.');
        }
        if($status === 'approved'){
            User::where('id', $application->user_id)->update(['role' => 'doctor']);
        } else{
            User::where('id', $application->user_id)->update(['role' => 'user']);
        }
        $application->status = $status;
        $application->is_active = true;
        $application->save();

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
    
    public function applicantHistory() {
        $status = request()->query('status');
        if(in_array($status, ['pending', 'approved', 'rejected', 'disabled'])) {
            $applicants = Application::where('status', $status)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('admin.pages.applicant.applicant_history', compact('applicants'));
        }
        $applicants = Application::orderBy('created_at', 'desc')->get();

        return view('admin.pages.applicant.applicant_history', compact('applicants'));
    }

    public function getArticleHtml() {
        $totalArticles = Article::count();
        $published = Article::where('status', 'published')->count();
        $draft = Article::where('status', 'draft')->count();

        $articles = Article::with('author')
            ->latest()
            ->limit(5)
            ->get();
        return view('admin.pages.article', ['articles' => $articles, 'totalArticles' => $totalArticles, 'published' => $published, 'draft' => $draft])->render();
    }

    public function getConsultationHtml() {
        $today = now()->startOfDay();

        $totalToday = Consultation::whereDate('created_at', today())->count();

        $active = Consultation::where('status', 'AKTIF')->count();
        $waiting = Consultation::where('status', 'MENUNGGU')->count();
        $finished = Consultation::where('status', 'SELESAI')->count();

        $consultations = Consultation::with(['user', 'doctor'])
            ->latest()
            ->limit(6)
            ->get();

        return view('admin.pages.konsultasi', ['today' => $today, 'totalToday' => $totalToday, 'active' => $active, 'waiting' => $waiting, 'finished' => $finished, 'consultations' => $consultations])->render();
    }

    public function consultationIndex()
    {
        $consultations = Consultation::with([
                'user:id,name',
                'doctor:id,full_name',
                'chat'
            ])
            ->latest()
            ->paginate(15);

        return view('admin.pages.consultation.index', compact('consultations'));
    }

    public function consultationDetail($consultations)
    {
        $consultation = Consultation::with('chat.messages.sender', 'chat')
            ->where('id', $consultations)
            ->firstOrFail();
        $chat = $consultation->chat;

        abort_if(!$chat, 404);

        $messages = $chat->messages()
            ->with('sender')
            ->latest()
            ->take(50)
            ->get()
            ->reverse();

        return view('admin.pages.consultation._monitor_modal', compact(
            'chat',
            'messages'
        ));
    }

    public function getKlikHomeHtml()
    {
        $totalServices   = KlikHomeService::count();
        $activeServices  = KlikHomeService::where('is_active', true)->count();
        $inactiveServices = KlikHomeService::where('is_active', false)->count();

        $totalOrders     = KlikHomeOrder::count();
        $pendingOrders   = KlikHomeOrder::where('status', 'MENUNGGU_PEMBAYARAN')->count();
        $scheduledOrders = KlikHomeOrder::where('status', 'DIBAYAR')->count();
        $completedOrders = KlikHomeOrder::where('status', 'SELESAI')->count();

        $services = KlikHomeService::latest()
            ->limit(12)
            ->get();

        $latestOrders = KlikHomeOrder::with('service')
            ->latest()
            ->limit(6)
            ->get();

        return view('admin.pages.klik-home', compact(
            'totalServices',
            'activeServices',
            'inactiveServices',
            'totalOrders',
            'pendingOrders',
            'scheduledOrders',
            'completedOrders',
            'services',
            'latestOrders'
        ))->render();
    }

    public function updateKlikHomeServiceStatus($serviceId)
    {
        $service = KlikHomeService::findOrFail($serviceId);
        $newStatus = request()->input('is_active') === "1" ? true : false;
        $service->is_active = $newStatus;
        $service->save();

        return response()->json([
            'success' => true,
            'message' => 'Service status updated successfully.',
            'is_active' => $service->is_active,
        ]);
    }

    public function updateKlikHomeService(Request $request, $id)
    {
        $service = KlikHomeService::findOrFail($id);
        $service->update($request->only([
            'name',
            'category',
            'price',
            'service_fee',
            'duration_minutes',
            'handled_by',
            'description',
            'is_active'
        ]));

        return response()->json(['success' => true]);
    }

    public function storeKlikHomeService(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|integer',
            'service_fee' => 'required|integer',
            'duration_minutes' => 'required|integer',
            'handled_by' => 'required|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);

        KlikHomeService::create($data);

        return response()->json(['success' => true]);
    }

    public function detailKlikHomeHistory($orderCode)
    {
        $order = KlikHomeOrder::with([
                'service',
                'address.cityRelation',
                'address.provinceRelation',
            ])
            ->where('order_code', $orderCode)
            ->when(auth()->user()->role !== 'admin', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->firstOrFail();

        return view('admin.pages.klikhome.order_detail', compact('order'));
    }

    public function KlikHomeOrderHistory(Request $request){
        $query = KlikHomeOrder::with([
            'user',
            'service',
            'address.cityRelation',
            'address.provinceRelation',
        ])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);

        return view('admin.pages.klikhome.order_history', compact('orders'));
    }

    public function updateKlikHomeOrder(Request $request, $orderCode)
    {
        $order = KlikHomeOrder::where('order_code', $orderCode)->firstOrFail();
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.klikhome.history.detail', $order->order_code)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    private function calculateGrowth()
    {
        $thisMonth = now()->month;
        $lastMonth = now()->subMonth()->month;

        $current =
            KlikHomeOrder::whereMonth('created_at', $thisMonth)->sum('total')
            + Consultation::whereMonth('created_at', $thisMonth)->sum('total')
            + Order::whereMonth('created_at', $thisMonth)->sum('total');

        $previous =
            KlikHomeOrder::whereMonth('created_at', $lastMonth)->sum('total')
            + Consultation::whereMonth('created_at', $lastMonth)->sum('total')
            + Order::whereMonth('created_at', $lastMonth)->sum('total');

        if ($previous == 0) return 0;

        return round((($current - $previous) / $previous) * 100, 1);
    }

    public function dashboard()
    {
        $globalRevenue =
            KlikHomeOrder::whereIn('status', ['SELESAI', 'DIBAYAR'])->sum('total')
            + Consultation::where('status', 'SELESAI')->sum('total')
            + Order::where('status', 'SELESAI')->sum('total');

        $totalTransactions =
            KlikHomeOrder::count()
            + Consultation::count()
            + Order::count();

        $activeUsers = User::whereHas('orders')
            ->orWhereHas('consultations')
            ->distinct()
            ->count();

        $completed =
            KlikHomeOrder::where('status', 'SELESAI')->count()
            + Consultation::where('status', 'SELESAI')->count()
            + Order::where('status', 'SELESAI')->count();

        $completionRate = $totalTransactions > 0
            ? round(($completed / $totalTransactions) * 100, 1)
            : 0;

        $global = [
            'revenue' => $globalRevenue,
            'transactions' => $totalTransactions,
            'users' => $activeUsers,
            'completion' => $completionRate,
            'growth' => $this->calculateGrowth(),
        ];

        $services = [

            'klikhome' => [
                'revenue' => KlikHomeOrder::where('status', 'SELESAI')->sum('total'),
                'orders' => KlikHomeOrder::count(),
                'completed' => KlikHomeOrder::where('status', 'SELESAI')->count(),
            ],

            'konsultasi' => [
                'revenue' => Consultation::where('status', 'SELESAI')->sum('total'),
                'sessions' => Consultation::count(),
                'doctors' => Consultation::distinct('doctor_id')->count('doctor_id'),
            ],

            'apotek' => [
                'revenue' => Order::where('status', 'SELESAI')->sum('total'),
                'orders' => Order::count(),
                'items' => DB::table('order_items')->sum('quantity'),
            ],

        ];

        /* ================= MONTHLY PERFORMANCE ================= */

        $monthly = collect(range(0, 5))->map(function ($i) use ($services) {

            $date = Carbon::now()->subMonths($i);

            $revenue =
                KlikHomeOrder::whereMonth('created_at', $date->month)->sum('total')
                + Consultation::whereMonth('created_at', $date->month)->sum('total')
                + Order::whereMonth('created_at', $date->month)->sum('total');

            $transactions =
                KlikHomeOrder::whereMonth('created_at', $date->month)->count()
                + Consultation::whereMonth('created_at', $date->month)->count()
                + Order::whereMonth('created_at', $date->month)->count();

            return [
                'label' => $date->translatedFormat('M Y'),
                'revenue' => $revenue,
                'transactions' => $transactions,
                'growth' => rand(-5, 20), // ✅ bisa diganti real MoM later
                'progress' => min(100, ($revenue / max($services['klikhome']['revenue'], 1)) * 100),
            ];
        })->values();

        return view('admin.pages.dashboard', compact(
            'global',
            'services',
            'monthly'
        ));
    }

    public function exportDashboardPdf()
    {
        /* ==== REUSE LOGIC ==== */
        $global = [
            'revenue' => KlikHomeOrder::where('status', 'SELESAI')->sum('total')
                + Consultation::where('status', 'SELESAI')->sum('total')
                + Order::where('status', 'SELESAI')->sum('total'),

            'transactions' =>
                KlikHomeOrder::count()
                + Consultation::count()
                + Order::count(),

            'users' => User::count(),
        ];

        $services = [
            'KlikHome' => KlikHomeOrder::where('status', 'SELESAI')->sum('total'),
            'Konsultasi' => Consultation::where('status', 'SELESAI')->sum('total'),
            'Apotek' => Order::where('status', 'SELESAI')->sum('total'),
        ];

        $monthly = collect(range(0, 5))->map(function ($i) {
            $date = now()->subMonths($i);

            return [
                'label' => $date->translatedFormat('M Y'),
                'revenue' =>
                    KlikHomeOrder::whereMonth('created_at', $date->month)->sum('total')
                    + Consultation::whereMonth('created_at', $date->month)->sum('total')
                    + Order::whereMonth('created_at', $date->month)->sum('total'),
            ];
        })->reverse()->values();

        /* ==== PDF ==== */
        $pdf = Pdf::loadView(
            'pdf.dashboard',
            compact('global', 'services', 'monthly')
        )->setPaper('a4', 'portrait');

        return $pdf->download(
            'dashboard-summary-' . now()->format('Y-m-d') . '.pdf'
        );
    }
}
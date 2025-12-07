<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Article;
use App\Models\Consultation;
use App\Models\Drug;
use App\Models\Order;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

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
}
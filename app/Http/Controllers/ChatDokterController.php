<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatDokterController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // =========================
        // LOAD CHAT + RELATION
        // =========================
        $query = Chat::with([
            'user',
            'doctor.application',
            'messages' => fn ($q) => $q->latest()->limit(1),
            'consultation', // 🔥 pakai consultation_id di chats
        ]);

        if ($user->role === 'doctor') {
            $query->where('doctor_id', $user->id);
        } else {
            $query->where('user_id', $user->id);
        }

        $chats = $query->get();

        // =========================
        // SORT BY LAST MESSAGE
        // =========================
        $chats = $chats->sortByDesc(function ($chat) {
            if ($chat->consultation && $chat->consultation->status === 'AKTIF') {
                return PHP_INT_MAX;
            }

            // ✅ PRIORITAS KEDUA: last message
            return optional($chat->messages->first())->created_at?->timestamp ?? 0;
        });

        $activechat = $chats->first();


        $messages = $activechat
            ? $activechat->messages()->orderBy('created_at')->get()
            : collect();

        // 🔥 SEKARANG AMBIL DARI RELASI consultation
        $activeConsultation = $activechat && $activechat->consultation && $activechat->consultation->status === 'AKTIF' ? $activechat->consultation : null;


        // =========================
        // RETURN VIEW
        // =========================
        $view = $user->role === 'doctor'
            ? 'dokter.chat.index'
            : 'layanan.chat_dokter.index';

        return view($view, [
            'chats'              => $chats,
            'activechat'         => $activechat,
            'messages'           => $messages,
            'authUser'           => $user,
            'activeConsultation' => $activeConsultation,
        ]);
    }

    // =====================================================
    // SEND MESSAGE (BLOCK JIKA KONSULTASI SELESAI)
    // =====================================================
    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'body'    => 'required|string',
        ]);
        Log::info('[CHAT] sendMessage called', $request->all());
        $chat = Chat::with('consultation')->findOrFail($request->chat_id);

        // ❌ BLOCK kalau konsultasi tidak aktif
        if (! $chat->consultation || $chat->consultation->status !== 'AKTIF') {
            return response()->json([
                'error' => 'Sesi konsultasi telah selesai'
            ], 403);
        }

        $message = Message::create([
            'chat_id'   => $chat->id,
            'sender_id' => auth()->id(),
            'body'      => $request->body,
        ]);

        Log::info('[CHAT] Message created', [
            'message_id' => $message->id,
            'chat_id' => $message->chat_id,
        ]);

        broadcast(new NewMessage($message))->toOthers();
        Log::info('[CHAT] Broadcast dispatched');
        return response()->json([
            'ok' => true,
            'message' => [
                'id'         => $message->id,
                'body'       => $message->body,
                'sender_id'  => $message->sender_id,
                'created_at' => $message->created_at->format('H:i'),
            ]
        ]);
    }

    // =====================================================
    // LOAD MESSAGES PER CHAT
    // =====================================================
    public function messages(Chat $chat)
    {
        $chat->load('consultation');

        $isActive = $chat->consultation && $chat->consultation->status === 'AKTIF';

        return response()->json([
            'messages' => $chat->messages()->orderBy('created_at')->get(),
            'consultation_status' => $isActive ? 'AKTIF' : 'SELESAI',
        ]);
    }

    // =====================================================
    // CALL START
    // =====================================================
    public function start(Chat $chat, Request $request)
    {
        $user = $request->user();

        if (! in_array($user->role, ['user', 'doctor', 'admin'])) {
            abort(403);
        }

        $type = $request->input('type', 'video');

        $chat->update([
            'call_status'     => 'in_call',
            'call_type'       => $type,
            'call_started_at' => now(),
            'call_ended_at'   => null,
        ]);

        return response()->json(['ok' => true]);
    }

    // =====================================================
    // CALL END
    // =====================================================
    public function end(Chat $chat, Request $request)
    {
        $user = $request->user();

        if (! in_array($user->role, ['user', 'doctor', 'admin'])) {
            abort(403);
        }

        $chat->update([
            'call_status'   => 'ended',
            'call_type'     => 'none',
            'call_ended_at' => now(),
        ]);

        return response()->json(['ok' => true]);
    }
}

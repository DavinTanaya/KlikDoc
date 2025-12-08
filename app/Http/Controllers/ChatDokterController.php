<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatDokterController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Chat::with([
            'user',
            'doctor.application',
            'messages' => fn ($q) => $q->latest()->limit(1),
            'consultation',
        ]);

        if ($user->role === 'doctor') {
            $query->where('doctor_id', $user->id);
        } else {
            $query->where('user_id', $user->id);
        }

        $chats = $query->get();

        $chats = $chats->sortByDesc(function ($chat) {
            if ($chat->consultation && $chat->consultation->status === 'AKTIF') {
                return PHP_INT_MAX;
            }

            return optional($chat->messages->first())->created_at?->timestamp ?? 0;
        });

        $activechat = $chats->first();


        $messages = $activechat
            ? $activechat->messages()->orderBy('created_at')->get()
            : collect();

        $activeConsultation = $activechat && $activechat->consultation && $activechat->consultation->status === 'AKTIF' ? $activechat->consultation : null;

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

    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'body'    => 'required|string',
        ]);
        Log::info('[CHAT] sendMessage called', $request->all());
        $chat = Chat::with('consultation')->findOrFail($request->chat_id);

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

    public function messages(Chat $chat)
    {
        $chat->load('consultation');

        $isActive = $chat->consultation
            && $chat->consultation->status === 'AKTIF';

        $messages = $chat->messages()
            ->orderBy('created_at')
            ->get()
            ->map(function ($msg) {
                $payload = [
                    'id'         => $msg->id,
                    'chat_id'    => $msg->chat_id,
                    'sender_id'  => $msg->sender_id,
                    'type'       => $msg->type,
                    'body'       => $msg->body,
                    'created_at' => $msg->created_at,
                ];

                if ($msg->type === 'prescription' && $msg->prescription_id) {
                    $payload['prescription_id'] = $msg->prescription_id;
                }

                if ($msg->type === 'referral' && $msg->referral_id) {
                    $referral = Referral::find($msg->referral_id);

                    if ($referral) {
                        $payload['referral_id'] = $referral->id;
                        $payload['referral'] = [
                            'destination' => $referral->destination,
                            'department'  => $referral->department,
                            'reason'      => $referral->reason,
                            'notes'       => $referral->notes,
                        ];
                    }
                }

                return $payload;
            });

        return response()->json([
            'messages' => $messages,
            'consultation_status' => $isActive ? 'AKTIF' : 'SELESAI',
            'user_id'   => $chat->user_id,
            'doctor_id' => $chat->doctor_id,
        ]);
    }

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

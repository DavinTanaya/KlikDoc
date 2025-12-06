<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Application;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatDokterController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'doctor') {
            $chats = Chat::where('doctor_id', $user->id)
                ->with([
                    'user', 
                    'doctor.application',
                    'messages' => fn($q) => $q->latest()->limit(1),
                ])
                ->get();
        } 
        else {
            $chats = Chat::where('user_id', $user->id)
                ->with([
                    'doctor.application',
                    'user',
                    'messages' => fn($q) => $q->latest()->limit(1),
                ])
                ->get();
        }

        $chats = $chats->sortByDesc(fn ($chat) =>
            $chat->messages->first()?->created_at ?? now()->subYears(10)
        );

        $activechat = $chats->first();
        $messages = $activechat
            ? $activechat->messages()->orderBy('created_at')->get()
            : collect();

        // -------- RETURN PAGE BERBEDA --------
        if ($user->role === 'doctor') {
            return view('dokter.chat.index', [
                'chats' => $chats,
                'activechat' => $activechat,
                'messages' => $messages,
                'authUser' => $user,
            ]);
        }

        // user
        return view('layanan.chat_dokter.index', [
            'chats' => $chats,
            'activechat' => $activechat,
            'messages' => $messages,
            'authUser' => $user,
        ]);
    }   


    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'body'    => 'required|string',
        ]);

        $message = Message::create([
            'chat_id'   => $request->chat_id,
            'sender_id' => auth()->id(),
            'body'      => $request->body,
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return response()->json([
            'ok' => true,
            'message' => [
                'id'        => $message->id,
                'body'      => $message->body,
                'sender_id' => $message->sender_id,
                'created_at'=> $message->created_at->format('H:i'),
            ]
        ]);
    }

    public function messages(Chat $chat)
    {
        return response()->json([
            'messages' => $chat->messages()->orderBy('created_at')->get()
        ]);
    }



    public function start(Chat $chat, Request $request)
    {
        $user = $request->user();

        // optional: boleh tambahkan policy
        if (! in_array($user->role, ['user', 'doctor', 'admin'])) {
            abort(403);
        }

        $type = $request->input('type', 'video'); // audio|video

        $chat->update([
            'call_status'    => 'in_call',
            'call_type'      => $type,
            'call_started_at'=> now(),
            'call_ended_at'  => null,
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

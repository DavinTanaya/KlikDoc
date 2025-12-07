<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $chatId;

    public function __construct(Message $message)
    {
        Log::info('[EVENT] NewMessage constructed', [
            'chat_id' => $message->chat_id,
            'message_id' => $message->id,
        ]);
        $this->chatId = $message->chat_id;

        $this->message = [
            'id'         => $message->id,
            'body'       => $message->body,
            'sender_id'  => $message->sender_id,
            'created_at' => $message->created_at->toISOString(),
            'type'       => $message->type,
            'prescription_id' => $message->prescription_id,
            'referral_id' => $message->referral_id,
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chats.' . $this->chatId);
    }

    public function broadcastAs()
    {
        return 'new-message';
    }
}


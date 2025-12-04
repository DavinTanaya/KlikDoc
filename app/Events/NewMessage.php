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

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $chatId;

    public function __construct(Message $message)
    {
        $this->chatId = $message->chat_id;

        $this->message = [
            'id'        => $message->id,
            'body'      => $message->body,
            'sender_id' => $message->sender_id,
            'created_at'=> $message->created_at->format('H:i'),
        ];
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chats.' . $this->chatId);
    }
}


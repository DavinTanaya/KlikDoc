<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Broadcast;



Broadcast::channel('chats.{chat}', function ($user, Chat $chat) {
    return
        $user->id === $chat->user_id ||
        $user->id === $chat->doctor_id ||
        $user->role === 'admin';
});

Broadcast::channel('calls.{chat}', function ($user, Chat $chat) {
    return
        $user->id === $chat->user_id ||
        $user->id === $chat->doctor_id ||
        $user->role === 'admin';
});
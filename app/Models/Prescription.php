<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prescription extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'chat_id',
        'doctor_id',
        'notes',
    ];
}

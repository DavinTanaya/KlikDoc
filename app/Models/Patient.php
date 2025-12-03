<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'user_id',
        'gender',
        'date_of_birth',
        'blood_type',
        'medical_history'
    ];
}

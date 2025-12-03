<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'user_id',
        'specialty',
        'license_number',
        'experience_years',
        'about',
        'price_per_session',
        'working_hours'
    ];
}

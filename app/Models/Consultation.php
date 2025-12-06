<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
     protected $fillable = [
        'user_id',
        'doctor_id',
        'consultation_code',
        'method',
        'consultation_fee',
        'service_fee',
        'platform_fee',
        'total',
        'status',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Application::class, 'doctor_id');
    }

    public function prescriptions()
    {
        return $this->hasOne(Prescription::class, 'consultation_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'consultation_id');
    }

    public function chat()
    {
        return $this->hasOne(Chat::class, 'consultation_id');
    }
}

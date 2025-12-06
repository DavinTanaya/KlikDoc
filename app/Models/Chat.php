<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id', 
        'doctor_id',
        'consultation_id',
        'status',
        'call_status',
        'call_type',
        'call_started_at',
        'call_ended_at',
    ];

    protected $casts = [
        'call_started_at' => 'datetime',
        'call_ended_at'   => 'datetime',
    ];

    public function isInCall(): bool
    {
        return $this->call_status === 'in_call';
    }

    public function user()  { 
        return $this->belongsTo(User::class, 'user_id'); 
    }
    public function doctor(){ 
        return $this->belongsTo(User::class, 'doctor_id'); 
    }
    public function messages(){ 
        return $this->hasMany(Message::class); 
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function isConsultationActive(): bool
    {
        return $this->consultation && $this->consultation->status === 'AKTIF';
    }
}

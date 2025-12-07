<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'consultation_id',
        'destination',
        'department',
        'reason',
        'notes',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'referral_id');
    }
}

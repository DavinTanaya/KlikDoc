<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prescription extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'consultation_id',
        'diagnosis',
        'notes',
    ];
    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function items()
    {
        return $this->hasMany(PrescriptionItem::class);
    }

}

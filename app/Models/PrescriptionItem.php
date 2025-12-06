<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PrescriptionItem extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'prescription_id',
        'drug_id',
        'qty',
    ];

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }
}

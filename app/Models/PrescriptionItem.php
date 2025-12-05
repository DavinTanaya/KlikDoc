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
        'medicine_id',
        'qty',
        'usage_instructions',
    ];
}

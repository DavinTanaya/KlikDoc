<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserCart extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'drug_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }
}

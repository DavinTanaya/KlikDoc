<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Drug extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'category',
        'image',
        'description',
        'short_description',
        'dosis',
        'price',
        'stock',
        'type',
        'is_active',
    ];

    public function userCarts()
    {
        return $this->hasMany(UserCart::class, 'drug_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'drug_id');
    }

    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class, 'drug_id');
    }
}

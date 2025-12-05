<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'drug_id',
        'quantity',
        'price',
        'total'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_id');
    }
}

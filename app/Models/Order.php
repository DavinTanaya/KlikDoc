<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'order_code',
        'subtotal',
        'shipping_fee',
        'service_fee',
        'voucher_discount',
        'total',
        'status',
        'payment_method',
        'midtrans_order_id',
        'midtrans_transaction_status',
        'snap_token'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}

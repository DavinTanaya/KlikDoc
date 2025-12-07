<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlikHomeOrder extends Model
{
    protected $fillable = [
        'order_code',
        'user_id',
        'klikhome_service_id',
        'user_address_id',
        'scheduled_date',
        'scheduled_time',
        'subtotal',
        'service_fee',
        'total',
        'status',
        'snap_token',
        'midtrans_order_id',
        'payment_type',
        'transaction_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(KlikHomeService::class, 'klikhome_service_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'user_address_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'discount_percentage',
        'discount_amount',
        'min_order_amount',
        'max_discount_amount',
        'expiry_date',
        'max_uses',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function isValid()
    {
        if (!$this->is_active) return false;

        if ($this->expiry_date && now()->gt($this->expiry_date)) return false;

        if ($this->max_uses && $this->used_count >= $this->max_uses) return false;

        return true;
    }
}

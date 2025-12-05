<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'phone_number',
        'address_line',
        'city',
        'province',
        'zip_code',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cityRelation()
    {
        return $this->belongsTo(City::class, 'city', 'city_id');
    }

    public function provinceRelation()
    {
        return $this->belongsTo(Province::class, 'province', 'province_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'address_id');
    }
}

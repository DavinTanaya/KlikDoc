<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $primaryKey = 'province_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'province_id',
        'name',
    ];

    public function city()
    {
        return $this->hasMany(City::class, 'province_id', 'province_id');
    }

    public function address()
    {
        return $this->hasMany(Address::class, 'province', 'province_id');
    }
}

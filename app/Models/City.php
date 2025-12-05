<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $primaryKey = 'city_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'city_id',
        'province_id',
        'name',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }

    public function address()
    {
        return $this->hasMany(Address::class, 'city', 'city_id');
    }

}

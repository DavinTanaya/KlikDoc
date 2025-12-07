<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlikHomeService extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'duration_minutes',
        'price',
        'service_fee',
        'handled_by',
        'icon_svg',
        'benefits',
        'inclusions',
        'safety_notes',
        'time_slots',
        'is_active',
    ];

    protected $casts = [
        'benefits'     => 'array',
        'inclusions'   => 'array',
        'safety_notes' => 'array',
        'time_slots'   => 'array',
        'is_active'    => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function orders()
    {
        return $this->hasMany(KlikHomeOrder::class);
    }
}

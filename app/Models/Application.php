<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'full_name',
        'nik',
        'gender',
        'str',
        'sip',
        'spesialisasi',
        'document',
        'status',
        'is_active',
        'experience_years',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'doctor_id', 'id');
    }

    public function averageRating()
    {
        return round($this->ratings()->avg('rating') ?? 0, 1);
    }

    public function ratingCount()
    {
        return $this->ratings()->count();
    }
}
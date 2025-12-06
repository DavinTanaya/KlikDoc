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
    ];
}

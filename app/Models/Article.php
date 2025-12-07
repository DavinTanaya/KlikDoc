<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'thumbnail',
        'status',
        'author_id',
        'author_role',
    ];

    /* ======================
       RELATION
    ====================== */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /* ======================
       SCOPE
    ====================== */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

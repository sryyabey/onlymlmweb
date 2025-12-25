<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocContent extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'seo_keywords',
        'seo_description',
        'seo_title',
        'image',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(DocCategory::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(DocTag::class)->withTimestamps();
    }
}

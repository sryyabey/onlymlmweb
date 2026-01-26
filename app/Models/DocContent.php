<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DocContent extends Model
{
    use HasTranslations;
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

    public $translatable = [
        'title',
        'excerpt',
        'body',
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

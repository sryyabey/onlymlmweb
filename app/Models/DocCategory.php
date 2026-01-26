<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DocCategory extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'is_active',
        'image',
        'description',
        'sort_order',
    ];

    public $translatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(DocCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(DocCategory::class, 'parent_id');
    }

    public function contents()
    {
        return $this->belongsToMany(DocContent::class)->withTimestamps();
    }
}

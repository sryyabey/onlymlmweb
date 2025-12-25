<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'is_active',
        'image',
        'description',
        'sort_order',
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

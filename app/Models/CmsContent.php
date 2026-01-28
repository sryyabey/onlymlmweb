<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CmsContent extends Model
{
    use HasTranslations;
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'alias',
    ];

    public $translatable = [
        'title',
        'body',
    ];

    public function category()
    {
        return $this->belongsTo(CmsCategory::class, 'category_id');
    }
}

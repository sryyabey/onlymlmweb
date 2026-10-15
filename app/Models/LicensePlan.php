<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LicensePlan extends Model
{
    protected $fillable = ['product_id', 'code', 'name', 'features', 'production_domain_limit', 'staging_domain_limit', 'active'];

    protected function casts(): array
    {
        return ['features' => 'array', 'active' => 'boolean'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(LicenseProduct::class, 'product_id');
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(License::class, 'plan_id');
    }
}

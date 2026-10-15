<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenseDomain extends Model
{
    protected $fillable = ['license_id', 'domain', 'environment', 'active'];

    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }

    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }
}

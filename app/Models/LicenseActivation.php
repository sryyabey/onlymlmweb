<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenseActivation extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['license_id', 'installation_id', 'domain', 'environment', 'package_version', 'php_version', 'laravel_version', 'bagisto_version', 'ip_address', 'activated_at', 'last_seen_at', 'deactivated_at'];

    protected function casts(): array
    {
        return ['activated_at' => 'datetime', 'last_seen_at' => 'datetime', 'deactivated_at' => 'datetime'];
    }

    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class);
    }
}

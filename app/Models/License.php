<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class License extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['plan_id', 'customer_name', 'customer_email', 'key_hash', 'key_ciphertext', 'key_last_four', 'status', 'plan_version', 'starts_at', 'expires_at', 'grace_until', 'last_validated_at', 'notes'];

    protected $hidden = ['key_hash', 'key_ciphertext'];

    protected function casts(): array
    {
        return ['key_ciphertext' => 'encrypted', 'starts_at' => 'datetime', 'expires_at' => 'datetime', 'grace_until' => 'datetime', 'last_validated_at' => 'datetime'];
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(LicensePlan::class, 'plan_id');
    }

    public function domains(): HasMany
    {
        return $this->hasMany(LicenseDomain::class);
    }

    public function activations(): HasMany
    {
        return $this->hasMany(LicenseActivation::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(LicenseEvent::class);
    }
}

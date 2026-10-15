<?php

namespace App\Services\Licensing;

use App\Models\License;

final class LicenseKeyService
{
    public function issue(License $license): string
    {
        $key = 'OM-BAG-'.implode('-', str_split(strtoupper(bin2hex(random_bytes(10))), 4));
        $license->forceFill(['key_hash' => hash('sha256', $key), 'key_ciphertext' => $key, 'key_last_four' => substr($key, -4)])->save();

        return $key;
    }

    public function find(string $key): ?License
    {
        return License::query()->with(['plan.product', 'domains'])->where('key_hash', hash('sha256', strtoupper(trim($key))))->first();
    }
}

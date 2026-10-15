<?php

namespace App\Services\Licensing;

use App\Models\License;
use RuntimeException;

final class LicenseDocumentSigner
{
    public function signedDocument(License $license): array
    {
        $license->loadMissing(['plan.product', 'domains']);
        $payload = [
            'license_id' => $license->id, 'product' => $license->plan->product->code, 'plan' => $license->plan->code,
            'features' => array_values($license->plan->features),
            'domains' => $license->domains->where('active', true)->where('environment', 'production')->pluck('domain')->values()->all(),
            'staging_domains' => $license->domains->where('active', true)->where('environment', 'staging')->pluck('domain')->values()->all(),
            'status' => now()->isAfter($license->expires_at) ? 'grace_period' : $license->status, 'plan_version' => $license->plan_version, 'issued_at' => now()->utc()->toIso8601String(),
            'starts_at' => $license->starts_at->utc()->toIso8601String(), 'expires_at' => $license->expires_at->utc()->toIso8601String(), 'grace_until' => $license->grace_until?->utc()->toIso8601String(),
        ];
        $document = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
        $privateKey = base64_decode((string) config('licensing.private_key'), true);

        if (! is_string($privateKey) || strlen($privateKey) !== SODIUM_CRYPTO_SIGN_SECRETKEYBYTES) {
            throw new RuntimeException('LICENSE_SIGNING_PRIVATE_KEY is missing or invalid.');
        }

        return ['document' => base64_encode($document), 'signature' => base64_encode(sodium_crypto_sign_detached($document, $privateKey)), 'public_key' => (string) config('licensing.public_key'), 'payload' => $payload];
    }
}

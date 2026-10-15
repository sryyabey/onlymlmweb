<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\LicenseActivation;
use App\Models\LicenseEvent;
use App\Services\Licensing\LicenseDocumentSigner;
use App\Services\Licensing\LicenseKeyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

final class LicenseController extends Controller
{
    public function __construct(private LicenseKeyService $keys, private LicenseDocumentSigner $signer) {}

    public function activate(Request $request): JsonResponse
    {
        $data = $this->validated($request);
        $license = $this->license($data['license_key'], $data['product']);
        $domain = $this->normalizeDomain($data['domain']);

        return DB::transaction(function () use ($license, $data, $domain, $request): JsonResponse {
            $this->authorizeDomain($license, $domain, $data['environment']);
            $activation = LicenseActivation::query()->updateOrCreate(
                ['license_id' => $license->id, 'installation_id' => $data['installation_id']],
                $this->activationData($data, $domain, $request) + ['activated_at' => now(), 'deactivated_at' => null],
            );
            $license->update(['last_validated_at' => now()]);
            $this->event($license, 'license.activated', $activation, $request);

            return response()->json(['valid' => true, 'activation_id' => $activation->id] + $this->signer->signedDocument($license));
        });
    }

    public function validateLicense(Request $request): JsonResponse
    {
        $data = $this->validated($request);
        $license = $this->license($data['license_key'], $data['product']);
        $domain = $this->normalizeDomain($data['domain']);
        $activation = LicenseActivation::query()->where('license_id', $license->id)->where('installation_id', $data['installation_id'])->where('domain', $domain)->where('environment', $data['environment'])->whereNull('deactivated_at')->firstOrFail();
        $activation->update($this->activationData($data, $domain, $request));
        $license->update(['last_validated_at' => now()]);
        $this->event($license, 'license.validated', $activation, $request);

        return response()->json(['valid' => true, 'activation_id' => $activation->id] + $this->signer->signedDocument($license));
    }

    public function heartbeat(Request $request): JsonResponse
    {
        $response = $this->validateLicense($request);

        return $response->setData(['heartbeat' => true] + $response->getData(true));
    }

    public function deactivate(Request $request): JsonResponse
    {
        $data = $request->validate(['license_key' => ['required', 'string'], 'product' => ['required', 'string'], 'installation_id' => ['required', 'string', 'max:100']]);
        $license = $this->license($data['license_key'], $data['product']);
        $activation = LicenseActivation::query()->where('license_id', $license->id)->where('installation_id', $data['installation_id'])->whereNull('deactivated_at')->firstOrFail();
        $activation->update(['deactivated_at' => now(), 'last_seen_at' => now()]);
        $this->event($license, 'license.deactivated', $activation, $request);

        return response()->json(['deactivated' => true]);
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'license_key' => ['required', 'string', 'max:100'], 'product' => ['required', 'string', 'max:100'], 'installation_id' => ['required', 'string', 'max:100'],
            'domain' => ['required', 'string', 'max:255'], 'environment' => ['required', Rule::in(['production', 'staging'])],
            'package_version' => ['nullable', 'string', 'max:50'], 'php_version' => ['nullable', 'string', 'max:50'], 'laravel_version' => ['nullable', 'string', 'max:50'], 'bagisto_version' => ['nullable', 'string', 'max:50'],
        ]);
    }

    private function license(string $key, string $product): License
    {
        $license = $this->keys->find($key);
        abort_if($license === null || $license->plan->product->code !== $product || ! $license->plan->product->active || ! $license->plan->active, 404, 'License not found.');
        abort_if(in_array($license->status, ['suspended', 'revoked', 'expired'], true), 403, 'License is not active.');
        abort_if(now()->isBefore($license->starts_at), 403, 'License has not started.');
        abort_if(now()->isAfter($license->grace_until ?? $license->expires_at), 403, 'License has expired.');

        return $license;
    }

    private function authorizeDomain(License $license, string $domain, string $environment): void
    {
        if ($license->domains->where('domain', $domain)->where('environment', $environment)->where('active', true)->isNotEmpty()) {
            return;
        }
        $limit = $environment === 'production' ? $license->plan->production_domain_limit : $license->plan->staging_domain_limit;
        abort_if($license->domains()->where('environment', $environment)->where('active', true)->count() >= $limit, 422, 'Domain limit reached.');
        $license->domains()->create(['domain' => $domain, 'environment' => $environment, 'active' => true]);
        $license->load('domains');
    }

    private function activationData(array $data, string $domain, Request $request): array
    {
        return ['domain' => $domain, 'environment' => $data['environment'], 'package_version' => $data['package_version'] ?? null, 'php_version' => $data['php_version'] ?? null, 'laravel_version' => $data['laravel_version'] ?? null, 'bagisto_version' => $data['bagisto_version'] ?? null, 'ip_address' => $request->ip(), 'last_seen_at' => now()];
    }

    private function event(License $license, string $type, LicenseActivation $activation, Request $request): void
    {
        LicenseEvent::query()->create(['license_id' => $license->id, 'event_type' => $type, 'installation_id' => $activation->installation_id, 'domain' => $activation->domain, 'ip_address' => $request->ip(), 'payload' => ['user_agent' => $request->userAgent()], 'occurred_at' => now()]);
    }

    private function normalizeDomain(string $domain): string
    {
        $host = parse_url(str_contains($domain, '://') ? $domain : 'https://'.$domain, PHP_URL_HOST);
        abort_if(! is_string($host) || $host === '', 422, 'Invalid domain.');

        return strtolower(rtrim($host, '.'));
    }
}

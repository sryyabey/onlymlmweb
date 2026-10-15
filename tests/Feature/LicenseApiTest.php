<?php

namespace Tests\Feature;

use App\Models\License;
use App\Models\LicensePlan;
use App\Models\LicenseProduct;
use App\Services\Licensing\LicenseKeyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LicenseApiTest extends TestCase
{
    use RefreshDatabase;

    private string $licenseKey;

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.key' => 'base64:'.base64_encode(random_bytes(32))]);
        $keypair = sodium_crypto_sign_keypair();
        config(['licensing.private_key' => base64_encode(sodium_crypto_sign_secretkey($keypair)), 'licensing.public_key' => base64_encode(sodium_crypto_sign_publickey($keypair))]);
        $product = LicenseProduct::query()->create(['code' => 'onlymlm-bagisto', 'name' => 'onlyMlm for Bagisto', 'active' => true]);
        $plan = LicensePlan::query()->create(['product_id' => $product->id, 'code' => 'professional', 'name' => 'Professional', 'features' => ['mlm', 'binary', 'exports'], 'production_domain_limit' => 1, 'staging_domain_limit' => 1, 'active' => true]);
        $license = License::query()->create(['plan_id' => $plan->id, 'customer_name' => 'Demo Company', 'customer_email' => 'demo@example.com', 'key_hash' => str_repeat('0', 64), 'key_ciphertext' => 'pending', 'key_last_four' => '0000', 'status' => 'active', 'plan_version' => 1, 'starts_at' => now()->subDay(), 'expires_at' => now()->addYear(), 'grace_until' => now()->addYear()->addDays(7)]);
        $this->licenseKey = app(LicenseKeyService::class)->issue($license);
    }

    public function test_license_can_be_activated_and_returns_a_verifiable_document(): void
    {
        $response = $this->postJson('/api/v1/licenses/activate', $this->payload())->assertOk()->assertJsonPath('valid', true)->assertJsonPath('payload.product', 'onlymlm-bagisto');
        $document = base64_decode($response->json('document'), true);
        $signature = base64_decode($response->json('signature'), true);
        $publicKey = base64_decode($response->json('public_key'), true);

        self::assertTrue(sodium_crypto_sign_verify_detached($signature, $document, $publicKey));
        $this->assertDatabaseCount('license_domains', 1);
        $this->assertDatabaseCount('license_activations', 1);
        $this->assertDatabaseHas('license_events', ['event_type' => 'license.activated']);
    }

    public function test_activation_is_idempotent_and_domain_limit_is_enforced(): void
    {
        $this->postJson('/api/v1/licenses/activate', $this->payload())->assertOk();
        $this->postJson('/api/v1/licenses/activate', $this->payload())->assertOk();
        $this->assertDatabaseCount('license_activations', 1);

        $this->postJson('/api/v1/licenses/activate', $this->payload(['installation_id' => 'installation-2', 'domain' => 'other.example.com']))->assertStatus(422);
    }

    public function test_license_can_be_validated_and_deactivated(): void
    {
        $this->postJson('/api/v1/licenses/activate', $this->payload())->assertOk();
        $this->postJson('/api/v1/licenses/validate', $this->payload())->assertOk();
        $this->postJson('/api/v1/licenses/deactivate', ['license_key' => $this->licenseKey, 'product' => 'onlymlm-bagisto', 'installation_id' => 'installation-1'])->assertOk()->assertJson(['deactivated' => true]);
        $this->postJson('/api/v1/licenses/validate', $this->payload())->assertNotFound();
    }

    private function payload(array $overrides = []): array
    {
        return $overrides + ['license_key' => $this->licenseKey, 'product' => 'onlymlm-bagisto', 'installation_id' => 'installation-1', 'domain' => 'shop.example.com', 'environment' => 'production', 'package_version' => '1.0.0', 'php_version' => '8.4.6', 'laravel_version' => '12.0', 'bagisto_version' => '2.3'];
    }
}

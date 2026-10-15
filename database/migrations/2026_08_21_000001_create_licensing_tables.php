<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_products', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('license_plans', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained('license_products')->cascadeOnDelete();
            $table->string('code');
            $table->string('name');
            $table->json('features');
            $table->unsignedSmallInteger('production_domain_limit')->default(1);
            $table->unsignedSmallInteger('staging_domain_limit')->default(1);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->unique(['product_id', 'code']);
        });

        Schema::create('licenses', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignId('plan_id')->constrained('license_plans')->restrictOnDelete();
            $table->string('customer_name');
            $table->string('customer_email')->index();
            $table->string('key_hash', 64)->unique();
            $table->text('key_ciphertext');
            $table->string('key_last_four', 4);
            $table->string('status')->default('active')->index();
            $table->unsignedInteger('plan_version')->default(1);
            $table->timestamp('starts_at');
            $table->timestamp('expires_at');
            $table->timestamp('grace_until')->nullable();
            $table->timestamp('last_validated_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('license_domains', function (Blueprint $table): void {
            $table->id();
            $table->foreignUuid('license_id')->constrained('licenses')->cascadeOnDelete();
            $table->string('domain');
            $table->string('environment')->default('production');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->unique(['license_id', 'domain']);
        });

        Schema::create('license_activations', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('license_id')->constrained('licenses')->cascadeOnDelete();
            $table->string('installation_id');
            $table->string('domain');
            $table->string('environment')->default('production');
            $table->string('package_version')->nullable();
            $table->string('php_version')->nullable();
            $table->string('laravel_version')->nullable();
            $table->string('bagisto_version')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('activated_at');
            $table->timestamp('last_seen_at');
            $table->timestamp('deactivated_at')->nullable();
            $table->timestamps();
            $table->unique(['license_id', 'installation_id']);
        });

        Schema::create('license_events', function (Blueprint $table): void {
            $table->id();
            $table->foreignUuid('license_id')->nullable()->constrained('licenses')->nullOnDelete();
            $table->string('event_type')->index();
            $table->string('installation_id')->nullable();
            $table->string('domain')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->json('payload')->nullable();
            $table->timestamp('occurred_at')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_events');
        Schema::dropIfExists('license_activations');
        Schema::dropIfExists('license_domains');
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('license_plans');
        Schema::dropIfExists('license_products');
    }
};

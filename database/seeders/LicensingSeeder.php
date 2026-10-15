<?php

namespace Database\Seeders;

use App\Models\LicensePlan;
use App\Models\LicenseProduct;
use Illuminate\Database\Seeder;

class LicensingSeeder extends Seeder
{
    public function run(): void
    {
        $product = LicenseProduct::query()->updateOrCreate(['code' => 'onlymlm-bagisto'], ['name' => 'onlyMlm for Bagisto', 'active' => true]);
        $plans = [
            'starter' => ['Starter', ['mlm', 'points', 'packages', 'careers']],
            'professional' => ['Professional', ['mlm', 'binary', 'points', 'packages', 'careers', 'exports']],
            'enterprise' => ['Enterprise', ['mlm', 'binary', 'points', 'packages', 'careers', 'exports', 'multi_tenant', 'financial_integration']],
        ];

        foreach ($plans as $code => [$name, $features]) {
            LicensePlan::query()->updateOrCreate(['product_id' => $product->id, 'code' => $code], ['name' => $name, 'features' => $features, 'production_domain_limit' => $code === 'enterprise' ? 5 : 1, 'staging_domain_limit' => $code === 'starter' ? 0 : 1, 'active' => true]);
        }
    }
}

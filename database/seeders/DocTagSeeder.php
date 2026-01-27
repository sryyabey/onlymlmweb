<?php

namespace Database\Seeders;

use App\Models\DocTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Getting Started',
                'slug' => 'getting-started',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Installation',
                'slug' => 'installation',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Configuration',
                'slug' => 'configuration',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Management',
                'slug' => 'user-management',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MLM Logic',
                'slug' => 'mlm-logic',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Binary System',
                'slug' => 'binary-system',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Commission & Income',
                'slug' => 'commission-income',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Payments',
                'slug' => 'payments',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Integrations',
                'slug' => 'integrations',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'name' => 'FAQ',
                'slug' => 'faq',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DocTag::insert($data);
    }
}

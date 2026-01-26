<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => [
                    'en' => 'Getting Started',
                    'tr' => 'Başlangıç',
                ],
                'slug' => 'getting-started',
                'parent_id' => null,
                'description' => [
                    'en' => 'Introduction and basic usage of the system',
                    'tr' => 'Sistemin tanıtımı ve temel kullanımı',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Installation',
                    'tr' => 'Kurulum',
                ],
                'slug' => 'installation',
                'parent_id' => null,
                'description' => [
                    'en' => 'Server and application installation steps',
                    'tr' => 'Sunucu ve uygulama kurulum adımları',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Configuration',
                    'tr' => 'Yapılandırma',
                ],
                'slug' => 'configuration',
                'parent_id' => null,
                'description' => [
                    'en' => 'System configuration and environment settings',
                    'tr' => 'Sistem ayarları ve ortam yapılandırmaları',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'MLM System',
                    'tr' => 'MLM Sistemi',
                ],
                'slug' => 'mlm-system',
                'parent_id' => null,
                'description' => [
                    'en' => 'Multi-level marketing structure and logic',
                    'tr' => 'Çok seviyeli pazarlama yapısı ve mantığı',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Binary System',
                    'tr' => 'Binary Sistem',
                ],
                'slug' => 'binary-system',
                'parent_id' => null,
                'description' => [
                    'en' => 'Binary tree logic and income flow',
                    'tr' => 'Binary ağaç yapısı ve kazanç akışı',
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => [
                    'en' => 'Payments & Earnings',
                    'tr' => 'Ödemeler ve Kazançlar',
                ],
                'slug' => 'payments-earnings',
                'parent_id' => null,
                'description' => [
                    'en' => 'Commissions, payouts and earnings calculations',
                    'tr' => 'Komisyonlar, ödemeler ve kazanç hesaplamaları',
                ],
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\DocCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}

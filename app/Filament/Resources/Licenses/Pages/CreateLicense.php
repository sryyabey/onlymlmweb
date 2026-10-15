<?php

namespace App\Filament\Resources\Licenses\Pages;

use App\Filament\Resources\Licenses\LicenseResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateLicense extends CreateRecord
{
    protected static string $resource = LicenseResource::class;

    private string $issuedKey;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->issuedKey = 'OM-BAG-'.implode('-', str_split(strtoupper(bin2hex(random_bytes(10))), 4));
        $data['key_hash'] = hash('sha256', $this->issuedKey);
        $data['key_ciphertext'] = $this->issuedKey;
        $data['key_last_four'] = substr($this->issuedKey, -4);

        return $data;
    }

    protected function afterCreate(): void
    {
        Notification::make()->success()->title('Lisans oluşturuldu')->body('Lisans anahtarı: '.$this->issuedKey)->persistent()->send();
    }
}

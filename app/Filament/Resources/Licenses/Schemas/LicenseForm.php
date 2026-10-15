<?php

namespace App\Filament\Resources\Licenses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LicenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('plan_id')->label('Plan')->relationship('plan', 'name')->required()->preload()->searchable(),
            Select::make('status')->options(['trial' => 'Trial', 'active' => 'Aktif', 'past_due' => 'Ödeme Gecikmiş', 'suspended' => 'Askıya Alındı', 'expired' => 'Süresi Doldu', 'revoked' => 'İptal Edildi'])->default('active')->required(),
            TextInput::make('customer_name')->label('Müşteri/Firma')->required()->maxLength(255),
            TextInput::make('customer_email')->label('E-posta')->email()->required()->maxLength(255),
            TextInput::make('plan_version')->label('Plan Sürümü')->numeric()->default(1)->minValue(1)->required(),
            DateTimePicker::make('starts_at')->label('Başlangıç')->default(now())->required(),
            DateTimePicker::make('expires_at')->label('Bitiş')->default(now()->addYear())->required()->after('starts_at'),
            DateTimePicker::make('grace_until')->label('Grace Bitişi')->default(now()->addYear()->addDays((int) config('licensing.grace_days', 7)))->after('expires_at'),
            TextInput::make('key_ciphertext')->label('Lisans Anahtarı')->disabled()->dehydrated(false)->visibleOn('edit')->formatStateUsing(fn ($record) => $record?->key_ciphertext),
            Repeater::make('domains')->label('Domainler')->relationship()->schema([
                TextInput::make('domain')->required()->maxLength(255),
                Select::make('environment')->options(['production' => 'Production', 'staging' => 'Staging'])->default('production')->required(),
                Toggle::make('active')->default(true)->required(),
            ])->columns(3)->columnSpanFull(),
            Textarea::make('notes')->label('Notlar')->columnSpanFull(),
        ]);
    }
}

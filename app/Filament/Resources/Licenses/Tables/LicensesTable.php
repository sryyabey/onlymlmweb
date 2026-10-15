<?php

namespace App\Filament\Resources\Licenses\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LicensesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('customer_name')->label('Müşteri')->searchable()->sortable(),
            TextColumn::make('customer_email')->label('E-posta')->searchable(),
            TextColumn::make('plan.name')->label('Plan')->badge(),
            TextColumn::make('status')->label('Durum')->badge()->sortable(),
            TextColumn::make('key_last_four')->label('Anahtar')->formatStateUsing(fn (string $state) => '••••-'.$state),
            TextColumn::make('domains.domain')->label('Domainler')->badge()->separator(','),
            TextColumn::make('expires_at')->label('Bitiş')->dateTime('d.m.Y H:i')->sortable(),
            TextColumn::make('last_validated_at')->label('Son Doğrulama')->dateTime('d.m.Y H:i')->placeholder('—')->sortable(),
        ])->recordActions([EditAction::make()]);
    }
}

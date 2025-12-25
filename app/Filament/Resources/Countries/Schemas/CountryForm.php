<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone_code')
                    ->tel()
                    ->default(null),
                TextInput::make('flag')
                    ->default(null),
                TextInput::make('code')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}

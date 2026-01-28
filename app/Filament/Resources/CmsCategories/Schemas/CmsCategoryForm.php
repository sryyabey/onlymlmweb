<?php

namespace App\Filament\Resources\CmsCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CmsCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->readOnly(),
                TextInput::make('parent_id')
                    ->numeric()
                    ->default(null),
            ]);
    }
}

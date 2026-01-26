<?php

namespace App\Filament\Resources\DocCategories\Pages;

use App\Filament\Resources\DocCategories\DocCategoryResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class CreateDocCategory extends CreateRecord
{
    use Translatable;
    protected static string $resource = DocCategoryResource::class;
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}

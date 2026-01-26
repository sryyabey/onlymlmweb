<?php

namespace App\Filament\Resources\DocCategories\Pages;

use App\Filament\Resources\DocCategories\DocCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class ListDocCategories extends ListRecords
{
    use Translatable;
    protected static string $resource = DocCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}

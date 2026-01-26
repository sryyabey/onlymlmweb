<?php

namespace App\Filament\Resources\DocContents\Pages;

use App\Filament\Resources\DocContents\DocContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class ListDocContents extends ListRecords
{
    use Translatable;
    protected static string $resource = DocContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}

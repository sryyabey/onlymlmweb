<?php

namespace App\Filament\Resources\CmsContents\Pages;

use App\Filament\Resources\CmsContents\CmsContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class ListCmsContents extends ListRecords
{
    use Translatable;
    protected static string $resource = CmsContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }
}

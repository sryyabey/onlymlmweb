<?php

namespace App\Filament\Resources\CmsContents\Pages;

use App\Filament\Resources\CmsContents\CmsContentResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class CreateCmsContent extends CreateRecord
{
    use Translatable;
    protected static string $resource = CmsContentResource::class;
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\DocContents\Pages;

use App\Filament\Resources\DocContents\DocContentResource;
use Filament\Resources\Pages\CreateRecord;
use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;

class CreateDocContent extends CreateRecord
{
    use Translatable;
    protected static string $resource = DocContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}

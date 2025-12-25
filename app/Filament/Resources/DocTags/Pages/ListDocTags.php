<?php

namespace App\Filament\Resources\DocTags\Pages;

use App\Filament\Resources\DocTags\DocTagResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocTags extends ListRecords
{
    protected static string $resource = DocTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

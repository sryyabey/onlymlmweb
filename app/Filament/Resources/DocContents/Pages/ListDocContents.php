<?php

namespace App\Filament\Resources\DocContents\Pages;

use App\Filament\Resources\DocContents\DocContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocContents extends ListRecords
{
    protected static string $resource = DocContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

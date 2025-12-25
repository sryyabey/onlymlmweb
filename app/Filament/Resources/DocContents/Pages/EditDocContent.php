<?php

namespace App\Filament\Resources\DocContents\Pages;

use App\Filament\Resources\DocContents\DocContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocContent extends EditRecord
{
    protected static string $resource = DocContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

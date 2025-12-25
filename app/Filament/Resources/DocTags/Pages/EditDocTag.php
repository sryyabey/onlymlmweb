<?php

namespace App\Filament\Resources\DocTags\Pages;

use App\Filament\Resources\DocTags\DocTagResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocTag extends EditRecord
{
    protected static string $resource = DocTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

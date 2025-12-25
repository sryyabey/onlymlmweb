<?php

namespace App\Filament\Resources\DocContents;

use App\Filament\Resources\DocContents\Pages\CreateDocContent;
use App\Filament\Resources\DocContents\Pages\EditDocContent;
use App\Filament\Resources\DocContents\Pages\ListDocContents;
use App\Filament\Resources\DocContents\Schemas\DocContentForm;
use App\Filament\Resources\DocContents\Tables\DocContentsTable;
use App\Models\DocContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DocContentResource extends Resource
{
    protected static ?string $model = DocContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    public static function getNavigationGroup(): ?string
    {
        return 'Documentation';
    }

    public static function form(Schema $schema): Schema
    {
        return DocContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocContentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDocContents::route('/'),
            'create' => CreateDocContent::route('/create'),
            'edit' => EditDocContent::route('/{record}/edit'),
        ];
    }
}

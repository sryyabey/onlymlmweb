<?php

namespace App\Filament\Resources\DocTags;

use App\Filament\Resources\DocTags\Pages\CreateDocTag;
use App\Filament\Resources\DocTags\Pages\EditDocTag;
use App\Filament\Resources\DocTags\Pages\ListDocTags;
use App\Filament\Resources\DocTags\Schemas\DocTagForm;
use App\Filament\Resources\DocTags\Tables\DocTagsTable;
use App\Models\DocTag;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DocTagResource extends Resource
{
    protected static ?string $model = DocTag::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    public static function getNavigationGroup(): ?string
    {
        return 'Documentation';
    }

    public static function form(Schema $schema): Schema
    {
        return DocTagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocTagsTable::configure($table);
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
            'index' => ListDocTags::route('/'),
            'create' => CreateDocTag::route('/create'),
            'edit' => EditDocTag::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\CmsContents;

use App\Filament\Resources\CmsContents\Pages\CreateCmsContent;
use App\Filament\Resources\CmsContents\Pages\EditCmsContent;
use App\Filament\Resources\CmsContents\Pages\ListCmsContents;
use App\Filament\Resources\CmsContents\Schemas\CmsContentForm;
use App\Filament\Resources\CmsContents\Tables\CmsContentsTable;
use App\Models\CmsContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Filament\Tables\Table;

class CmsContentResource extends Resource
{
    use Translatable;

    protected static ?string $model = CmsContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CmsContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CmsContentsTable::configure($table);
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
            'index' => ListCmsContents::route('/'),
            'create' => CreateCmsContent::route('/create'),
            'edit' => EditCmsContent::route('/{record}/edit'),
        ];
    }
}

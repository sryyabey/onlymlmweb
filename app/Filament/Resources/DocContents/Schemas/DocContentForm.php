<?php

namespace App\Filament\Resources\DocContents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Icerik')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('excerpt')
                            ->default(null)
                            ->columnSpanFull()
                            ->rows(3),
                        RichEditor::make('body')
                            ->default(null)
                            ->columnSpanFull()
                            ->extraAttributes(['style' => 'min-height: 320px;']),
                    ])
                    ->columns(2),
                Section::make('Meta Bilgiler')
                    ->schema([
                        TextInput::make('seo_title')
                            ->default(null)
                            ->columnSpanFull(),
                        TextInput::make('seo_keywords')
                            ->default(null)
                            ->columnSpanFull(),
                        Textarea::make('seo_description')
                            ->default(null)
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns(2),
                Section::make('Yayin ve Etiketler')
                    ->schema([
                        Select::make('categories')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->columnSpanFull(),
                        Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('slug')
                                    ->required(),
                                Toggle::make('is_active')
                                    ->default(true),
                            ])
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                        Toggle::make(name: 'is_private')
                            ->default(false)
                            ->required(),
                        DateTimePicker::make('published_at'),
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')              // 🔑 ASIL OLAY BU
                            ->directory('doc')
                            ->visibility('public')        // (opsiyonel ama netlik için iyi)
                            ->imagePreviewHeight('120')
                            ->downloadable()
                            ->openable()
                            ->maxSize(5120) // 5MB
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}

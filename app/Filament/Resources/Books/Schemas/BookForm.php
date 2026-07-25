<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255),

                TextInput::make('author')
                    ->label('Penulis')
                    ->required()
                    ->maxLength(255),

                TextInput::make('category')
                    ->label('Kategori')
                    ->required()
                    ->maxLength(255),

                TextInput::make('publication_year')
                    ->label('Tahun Terbit')
                    ->numeric()
                    ->required(),

                TextInput::make('stock')
                    ->label('Stok')
                    ->numeric()
                    ->minValue(0)
                    ->required(),

                FileUpload::make('cover')
                    ->label('Sampul Buku')
                    ->image()
                    ->directory('books')
                    ->visibility('public')
                    ->nullable(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->nullable(),
            ]);
    }
}
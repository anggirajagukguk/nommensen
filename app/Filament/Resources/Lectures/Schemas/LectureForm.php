<?php

namespace App\Filament\Resources\Lectures\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LectureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('nidn')
                    ->required(),
                TextInput::make('pendidikan')
                    ->required(),
                TextInput::make('jabatan')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('topik')
                    ->required(),
                FileUpload::make('image')
                    ->label('Foto Dosen')
                    ->image()
                    ->directory('lectures')
                    ->visibility('public')
                    ->imagePreviewHeight('200')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Upload foto formal dosen. Format: JPG, PNG. Maks 2MB.')
                    ->columnSpanFull(),
            ]);
    }
}

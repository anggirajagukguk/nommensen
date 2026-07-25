<?php

namespace App\Filament\Resources\Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Cover')
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->toggleable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('publication_year')
                    ->label('Tahun')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable()
                    ->alignCenter()
                    ->formatStateUsing(fn ($state) => $state > 0 ? $state : 'Habis')
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

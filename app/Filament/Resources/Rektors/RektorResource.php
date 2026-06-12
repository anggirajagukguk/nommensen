<?php

namespace App\Filament\Resources\Rektors;

use App\Filament\Resources\Rektors\Pages\CreateRektor;
use App\Filament\Resources\Rektors\Pages\EditRektor;
use App\Filament\Resources\Rektors\Pages\ListRektors;
use App\Filament\Resources\Rektors\Pages\ViewRektor;
use App\Models\Rektor;
use BackedEnum;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class RektorResource extends Resource
{
    protected static ?string $model = Rektor::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Pimpinan';
    protected static ?string $modelLabel = 'Pimpinan';
    protected static ?string $pluralModelLabel = 'Pimpinan';
    protected static UnitEnum|string|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Prof. Dr. H. Maman Suherman, M.Pd.'),

                Forms\Components\TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Rektor / Wakil Rektor I / Wakil Rektor II')
                    ->helperText('Tuliskan jabatan struktural di pimpinan universitas.'),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto')
                    ->image()
                    ->directory('rektors')
                    ->visibility('public')
                    ->imagePreviewHeight('200')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Upload foto formal dengan latar polos. Format: JPG, PNG. Maks 2MB.')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->height(80)
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRektors::route('/'),
            'create' => CreateRektor::route('/create'),
            'edit' => EditRektor::route('/{record}/edit'),
        ];
    }
}
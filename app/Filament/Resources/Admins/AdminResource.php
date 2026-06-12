<?php

namespace App\Filament\Resources\Admins;

use App\Filament\Resources\Admins\Pages\CreateAdmin;
use App\Filament\Resources\Admins\Pages\EditAdmin;
use App\Filament\Resources\Admins\Pages\ListAdmins;
use App\Filament\Resources\Admins\Pages\ViewAdmin;
use App\Models\Admin;
use BackedEnum;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Admin / Staf';
    protected static ?string $modelLabel = 'Admin';
    protected static ?string $pluralModelLabel = 'Admin / Staf';
    protected static UnitEnum|string|null $navigationGroup = 'Manajemen SDM';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Drs. Budi Santoso, M.M.'),

                Forms\Components\TextInput::make('nip')
                    ->label('NIP')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: 197505102001011001')
                    ->helperText('Nomor Induk Pegawai (boleh berupa NIP atau NIPK).'),

                Forms\Components\TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('contoh: Kepala Tata Usaha'),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto')
                    ->image()
                    ->directory('admins')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->maxSize(2048)
                    ->required()
                    ->helperText('Upload foto formal. Format: JPG, PNG. Maks 2MB.')
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
                    ->height(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('NIP berhasil disalin!'),

                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
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
            ->defaultSort('nama', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),
        ];
    }
}
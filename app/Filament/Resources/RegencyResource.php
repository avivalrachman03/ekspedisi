<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegencyResource\Pages;
use App\Filament\Resources\RegencyResource\RelationManagers;
use App\Models\Regency;
use Egulias\EmailValidator\Parser\IDRightPart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegencyResource extends Resource
{
    protected static ?string $model = Regency::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Master Data';

    public static ?string $navigationLabel = 'Kota ($)';

    public static ?string $pluralLabel = 'Kota';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('province_id')
                    ->relationship('province', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Provinsi')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->unique(ignoreRecord: true)
                    ->maxLength(5)
                    ->label('Kode Kota')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->label('Nama Kota')
                    ->required(),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->label('Harga / KG')
                    ->prefix('RP'),
                Forms\Components\TextInput::make('estimation')
                    ->label('Estimasi Hari Pengiriman')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Regency Code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Regency Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province.name')
                    ->label('Province')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->label('Price / KG')
                    ->money('IDR', true, 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListRegencies::route('/'),
            'create' => Pages\CreateRegency::route('/create'),
            'edit' => Pages\EditRegency::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengirimResource\Pages;
use App\Filament\Resources\PengirimResource\RelationManagers;
use App\Models\Pengirim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengirimResource extends Resource
{
    protected static ?string $model = Pengirim::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';


    public static function getFormPengirim()
    {
        return[
            Forms\Components\TextInput::make('name')
                ->required(),
            Forms\Components\TextInput::make('phone')
                ->tel()
                ->unique(ignoreRecord: true)
                ->required(),
            Forms\Components\TextInput::make('address')
                ->required(),
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                self::getFormPengirim()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
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
            'index' => Pages\ListPengirims::route('/'),
            'create' => Pages\CreatePengirim::route('/create'),
            'edit' => Pages\EditPengirim::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Exports\PaketExporter;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Paket;
use App\Models\Vendor;
use App\Models\Regency;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;

use Filament\Actions\Action;
use Filament\Resources\Resource;
use function PHPSTORM_META\type;
use Filament\Actions\ActionGroup;
use function Laravel\Prompts\form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PaketResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaketResource\RelationManagers;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;

class PaketResource extends Resource
{
    protected static ?string $model = Paket::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pengirim_id')
                    ->relationship('pengirim', 'name')
                    ->createOptionForm(
                        \App\filament\Resources\PengirimResource::getFormPengirim()
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_pengiriman')
                    ->format('Y-m-d')
                    ->default(today())
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        $date = \Illuminate\Support\Carbon::parse($state);
                        $chek = $date->format('Y-m-d');
                        $tanggal = $date->format('ymd');
                        $queri = Paket::query()->where('tanggal_pengiriman', $chek);
                        $count = $queri->count() + 1;
                        $set('no_resi', "PC" . $tanggal . str_pad($count, 4, '0', STR_PAD_LEFT));
                    })->required(),
                Forms\Components\TextInput::make('no_resi')
                    // ->default()
                    ->unique(ignoreRecord: true)
                    ->label('No Resi')
                    ->required(),
                Forms\Components\TextInput::make('nama_paket')
                    ->label('Nama Barang')
                    ->required(),
                Forms\Components\Group::make(
                    [
                        Forms\Components\TextInput::make('panjang')
                            ->numeric()
                            ->minValue(10)
                            ->label('P (cm)'),
                        Forms\Components\TextInput::make('lebar')
                            ->numeric()
                            ->minValue(10)
                            ->label('L (cm)'),
                        Forms\Components\TextInput::make('tinggi')
                            ->numeric()
                            // ->minValue(10)
                            ->reactive()
                            ->afterStateUpdated(
                                function ($state, Get $get, Set $set) {
                                    $panjang = $get('panjang');
                                    $lebar = $get('lebar');
                                    $tinggi = $state;
                                    if ($tinggi != null && $panjang != null && $lebar != null && $panjang >= 10 && $lebar >= 10 && $tinggi >= 10) {
                                        // $set('volume', null);
                                        $volume = $panjang * $lebar * $tinggi;
                                        $set('volume', $volume);
                                        $hitung = $volume / 5000;
                                        $angkaSetelahKoma = floor($hitung);
                                        if ($hitung - $angkaSetelahKoma >= 0.5) {
                                            $angkaSetelahKoma += 1;
                                        }
                                        $pembulatan = $angkaSetelahKoma;
                                        $set('berat', $pembulatan);
                                    } else {
                                        $set('volume', null);
                                        $set('berat', null);
                                    }
                                }
                            )
                            ->label('T (cm)'),
                    ]

                )->columns(3)
                    ->hiddenOn('edit' || 'view'),
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('volume')
                        ->readOnly()
                        ->numeric(),
                    Forms\Components\TextInput::make('koli')
                        ->numeric()
                        ->minValue(1)
                        ->default(1)
                        ->required(),
                ])->columns(2),
                Forms\Components\TextInput::make('berat')
                        ->live()
                        ->afterStateUpdated(
                            function ($state, Get $get, Set $set) {
                                // if ($state != null && $state < 30) {
                                //     $set('berat', 30);
                                // }
                                $harga = $get('harga');
                                $set('total', $state * $harga);
                            }
                        )
                        ->numeric()
                        ->required()
                        ->label('Berat (min 30kg)'),
                Forms\Components\Select::make('province_id')
                    ->label('Provinsi Tujuan')
                    ->relationship('province', 'name')
                    ->options(Province::all()->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('regencies_id', null))
                    ->required(),
                Forms\Components\Select::make('regencies_id')
                    ->options(fn(Get $get) => Regency::query()->where('province_id', $get('province_id'))->pluck('name', 'id'))
                    ->preload()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(
                        function ($state, Set $set, Get $get) {
                            $harga = Regency::find($state);
                            $berat = $get('berat');
                            if (!$harga) {
                                $set('harga', null);
                                $set('total', null);
                                return;
                            }
                            $set('harga', $harga->harga);
                            $set('total', $berat * $harga->price);
                        }
                    )
                    ->label('Kota Tujuan')
                    ->required(),
                Forms\Components\textInput::make('harga')
                    // ->readOnly()
                    ->live()
                    ->prefix('Rp.')
                    ->label('Ongkir / Kg'),
                Forms\Components\TextInput::make('nama_penerima')
                    ->required(),
                Forms\Components\TextInput::make('hp_penerima')
                    ->tel()
                    ->required(),
                Forms\Components\Textarea::make('alamat_penerima')
                    ->required(),
                // Group::make([
                    Forms\Components\Select::make('vendor_id')
                        ->options(Vendor::all()->pluck('name', 'id'))
                        ->createOptionForm(
                            \App\filament\Resources\VendorResource::getFormVendor()
                        )
                        ->live()
                        ->afterStateUpdated(fn(Set $set) => $set('resi_vendor', null))
                        ->default(null)
                        ->searchable()
                        ->preload(),
                    Forms\Components\TextInput::make('resi_vendor')
                        ->required(fn(Get $get) => $get('vendor_id') != null),
                // ]),
                Forms\components\TextInput::make('tambahan')
                    ->prefix('Rp.')
                    ->live()
                    ->numeric(),

                Forms\Components\TextInput::make('total')
                    ->numeric()
                    ->stripCharacters('Rp.', ' ')
                    ->prefix('Rp.')
                    ->readOnly( function (Set $set, $state, Get $get) {
                        $tambahan = (int)$get('tambahan') ?? 0;
                        $harga = (int)$get('harga') ?? 0;
                        $berat = (int)$get('berat') ?? 0;


                        $set('total', $harga * $berat + $tambahan);
                    })
                    ->required(),
                    Forms\Components\Textarea::make('keterangan')
                        ->maxLength(200)
                        ->placeholder('Catatan jika ada biaya tambahan'),
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id)
            ])
            ->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_pengiriman')
                    ->searchable()
                    ->sortable()
                    ->label('Tanggal'),
                Tables\Columns\TextColumn::make('no_resi')
                    ->searchable()
                    ->label('No Resi'),
                Tables\Columns\TextColumn::make('berat')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pengirim.name')
                    ->searchable()
                    ->label('Pengirim'),
                Tables\Columns\TextColumn::make('nama_penerima')
                    ->searchable(),
                Tables\Columns\TextColumn::make('regencies.code')
                    ->numeric()
                    ->sortable()
                    ->label('Kota'),
                Tables\Columns\TextColumn::make('regencies.province.name')
                    ->numeric()
                    ->sortable()
                    ->label('Provinsi'),
                Tables\Columns\TextColumn::make('total')
                    ->numeric(),
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
            ->query(function (Paket $query) {
                return $query->where('deleted_at', null);
            })
            ->filters([

            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('cetak')
                    ->label('Print')
                    ->icon('heroicon-s-printer')
                    ->url(fn(Paket $record) => route('cetak', $record->id))
                    ->openUrlInNewTab(true),
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    // Auth::user()->hasRole('admin') ? 
                    Tables\Actions\Action::make('Delete')
                        ->icon('heroicon-s-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Paket $record) {
                            Db::table('pakets')->where('id', $record->id)->update(['deleted_at' => now()->format('Y-m-d H:i:s')]);
                        }) 
                        ,
                ]),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->exporter(PaketExporter::class)
                        ->label('Export Laporan')
                        ->fileDisk('public'),
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
            'index' => Pages\ListPakets::route('/'),
            'create' => Pages\CreatePaket::route('/create'),
            // 'edit' => Pages\EditPaket::route('/{record}/edit'),
        ];
    }
}

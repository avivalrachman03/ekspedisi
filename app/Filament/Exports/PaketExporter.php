<?php

namespace App\Filament\Exports;

use App\Models\Paket;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;

class PaketExporter extends Exporter
{
    protected static ?string $model = Paket::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('tanggal_pengiriman')->label('Tanggal'),
            ExportColumn::make('no_resi'),
            ExportColumn::make('nama_paket'),
            ExportColumn::make('berat'),
            ExportColumn::make('alamat_penerima')->label('Alamat'),
            ExportColumn::make('province.name')->label('Provinsi'),
            ExportColumn::make('regencies.name')->label('Kota'),
            ExportColumn::make('pengirim.name'),
            ExportColumn::make('vendor.name'),
            ExportColumn::make('resi_vendor')->label('VResi'),
            ExportColumn::make('koli'),
            ExportColumn::make('total'),
            ExportColumn::make('user.name')->label('Counter'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your paket export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getXlsxHeaderCellStyle(): ?Style
    {
        return (new Style())
            ->setFontBold()
            ->setFontItalic()
            ->setFontSize(8)
            ->setFontName('Consolas')
            ->setFontColor(Color::rgb(0, 0, 0))
            ->setBackgroundColor(Color::rgb(220, 220, 220))
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER);
    }
    public function getXlsxCellStyle(): ?Style
    {
        return (new Style())
            ->setFontSize(7)
            ->setShouldWrapText(true);
    }
}

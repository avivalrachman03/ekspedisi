<?php

namespace App\Filament\Widgets;

use App\Models\Paket;
use Carbon\Carbon;
use Flowframe\Trend\Trend;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Interaction;

class PaketChart extends ChartWidget 
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Grafik Transaksi';

    protected static ?int $sort = 3;

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $user = $this->filters['user'] ?? Auth::user()->id;
        $start = $this->filters['startDate'] ;
        $end = $this->filters['endDate'];

        $paket = Trend::model(Paket::class)
            ->between(
                start: $start   ? Carbon::parse($start): now()->startOfWeek(),
                end: $end   ? Carbon::parse($end): now(),
            )
            ->perDay()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Paket',
                    'data' => $paket->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => 'rgb(53, 162, 235)',
                    
                ]
            ],
            'labels' => [
                ...$paket->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('d M')),
            ],
        ];
    }
    

    protected function getType(): string
    {
        return 'line';
    }
}

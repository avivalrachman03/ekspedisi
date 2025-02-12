<?php

namespace App\Filament\Widgets;

use App\Models\Paket;
use Flowframe\Trend\Trend;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class Pendapatan extends BaseWidget
{
    use InteractsWithPageFilters;
    protected static ?int $sort = 2;

    protected function getStats(): array
    {   
        $start = $this->filters['startDate'] ?? now()->startOfWeek();
        $end = $this->filters['endDate'] ?? now();
        return [
            Stat::make('Pendapatan','Rp. '. number_format(Paket::whereBetween('created_at', [$start, $end])->sum('total') ?? 0 , 0, ',', '.'))
                
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pemasukan', 'Rp1.200.000')
                ->description('Rp200.000 penambahan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Customer', '150')
                ->description('5 customer baru')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('warning'),
            Stat::make('Total Pesanan', '1520')
                ->description('10 pesanan baru')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),

        ];
    }
}

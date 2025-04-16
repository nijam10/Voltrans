<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class OrderChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        return [
            'datasets' => [
            [
                'label' => 'Blog posts created',
                'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                'backgroundColor' => '#36A2EB',
                'borderColor' => '#9BD0F5',
            ],
        ],
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

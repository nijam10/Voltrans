<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReviewChart extends ChartWidget
{
    protected static ?string $heading = 'Trend Review';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $days = collect();
        $reviews = collect();
        $ratings = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days->push($date->format('d/m'));
            
            $dailyReviews = Review::whereDate('created_at', $date)->count();
            $reviews->push($dailyReviews);
            
            $dailyRating = Review::whereDate('created_at', $date)->avg('rating') ?? 0;
            $ratings->push(round($dailyRating, 1));
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Review',
                    'data' => $reviews->toArray(),
                    'borderColor' => '#4C956C',
                    'backgroundColor' => 'rgba(76, 149, 108, 0.1)',
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Rating Rata-rata',
                    'data' => $ratings->toArray(),
                    'borderColor' => '#FFD700',
                    'backgroundColor' => 'rgba(255, 215, 0, 0.1)',
                    'tension' => 0.4,
                    'yAxisID' => 'y1',
                ],
            ],
            'labels' => $days->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Review',
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'beginAtZero' => true,
                    'max' => 5,
                    'title' => [
                        'display' => true,
                        'text' => 'Rating',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ];
    }
} 
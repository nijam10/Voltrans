<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ReviewStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalReviews = Review::count();
        $averageRating = Review::avg('rating') ?? 0;
        $recentReviews = Review::where('created_at', '>=', now()->subDays(7))->count();
        
        // Get rating distribution
        $ratingDistribution = Review::select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        return [
            Stat::make('Total Review', $totalReviews)
                ->description('Semua review yang diterima')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('primary'),

            Stat::make('Rating Rata-rata', number_format($averageRating, 1))
                ->description('Rating rata-rata dari semua review')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Review Minggu Ini', $recentReviews)
                ->description('Review dalam 7 hari terakhir')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success'),

            Stat::make('Rating 5 ⭐', $ratingDistribution[5] ?? 0)
                ->description('Review dengan rating tertinggi')
                ->descriptionIcon('heroicon-m-star')
                ->color('success'),

            Stat::make('Rating 1-2 ⭐', ($ratingDistribution[1] ?? 0) + ($ratingDistribution[2] ?? 0))
                ->description('Review dengan rating rendah')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
} 
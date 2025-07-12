<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Mokhosh\FilamentRating\Columns\RatingColumn;

class LatestReviews extends BaseWidget
{
    protected static ?string $heading = 'Review Terbaru';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Review::query()
                    ->with(['customer', 'product'])
                    ->latest()
            )
            ->columns([
                Tables\Columns\ImageColumn::make('product.thumbnail')
                    ->label('Produk')
                    ->size(100)
                    ->disk('s3'),
                
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->limit(20),
                
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->limit(25),
                
                RatingColumn::make('rating')
                    ->label('Rating')
                    ->size('sm'),
                
                Tables\Columns\TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(30)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),
            ])
            ->paginated(false)
            ->defaultSort('created_at', 'desc');
    }
} 
<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Mokhosh\FilamentRating\Components\Rating;

class ViewReview extends ViewRecord
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus Review')
                ->icon('heroicon-o-trash'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Customer')
                    ->schema([
                        Infolists\Components\TextEntry::make('customer.name')
                            ->label('Nama Customer')
                            ->size('lg')
                            ->weight('bold'),
                        Infolists\Components\TextEntry::make('customer.email')
                            ->label('Email Customer')
                            ->icon('heroicon-o-envelope'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Informasi Produk')
                    ->schema([
                        Infolists\Components\ImageEntry::make('product.thumbnail')
                            ->label('Gambar Produk')
                            ->disk('s3')
                            ->size(200),
                        Infolists\Components\TextEntry::make('product.name')
                            ->label('Nama Produk')
                            ->size('lg')
                            ->weight('bold'),
                        Infolists\Components\TextEntry::make('product.category.name')
                            ->label('Kategori')
                            ->badge(),
                        Infolists\Components\TextEntry::make('product.price')
                            ->label('Harga')
                            ->money('IDR', true)
                            ->badge()
                            ->color('success'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Detail Review')
                    ->schema([
                        Infolists\Components\TextEntry::make('rating')
                            ->label('Rating')
                            ->formatStateUsing(fn (int $state): string => str_repeat('⭐', $state))
                            ->size('lg'),
                        Infolists\Components\TextEntry::make('comment')
                            ->label('Komentar')
                            ->markdown()
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Tanggal Review')
                            ->dateTime('d/m/Y H:i')
                            ->icon('heroicon-o-calendar'),
                    ])
                    ->columns(2),
            ]);
    }
} 
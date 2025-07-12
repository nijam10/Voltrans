<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Product;
use App\Models\User;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $activeNavigationIcon = 'heroicon-s-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Ulasan';

    protected static ?string $breadcrumb = 'Ulasan';

    protected static ?string $label = 'List Ulasan';

    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Review')
                    ->schema([
                        Select::make('customer_id')
                            ->label('Customer')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->required()
                            ->columnSpan(1),
                        Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Review Details')
                    ->schema([
                        Rating::make('rating')
                            ->label('Rating')
                            ->required()
                            ->columnSpan(1),
                        Textarea::make('comment')
                            ->label('Komentar')
                            ->rows(4)
                            ->placeholder('Tulis ulasan Anda tentang produk ini...')
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('product.thumbnail')
                    ->label('Gambar Produk')
                    ->size(100)
                    ->disk('s3'),
                
                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                
                TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable()
                    ->limit(30)
                    ->weight('medium'),
                
                RatingColumn::make('rating')
                    ->label('Rating')
                    ->size('sm'),
                
                TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(50)
                    ->wrap()
                    ->searchable(),
                
                TextColumn::make('created_at')
                    ->label('Tanggal Review')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),
                
                BadgeColumn::make('rating')
                    ->label('Rating Badge')
                    ->colors([
                        'danger' => 1,
                        'warning' => 2,
                        'warning' => 3,
                        'success' => 4,
                        'success' => 5,
                    ])
                    ->formatStateUsing(fn (int $state): string => "{$state} ⭐")
                    ->size('sm'),
            ])
            ->filters([
                SelectFilter::make('rating')
                    ->label('Filter Rating')
                    ->options([
                        1 => '1 ⭐ - Sangat Buruk',
                        2 => '2 ⭐ - Buruk',
                        3 => '3 ⭐ - Cukup',
                        4 => '4 ⭐ - Baik',
                        5 => '5 ⭐ - Sangat Baik',
                    ])
                    ->multiple()
                    ->placeholder('Pilih rating...'),
                
                SelectFilter::make('customer')
                    ->label('Filter Customer')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->multiple()
                    ->placeholder('Pilih customer...'),
                
                SelectFilter::make('product')
                    ->label('Filter Produk')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->multiple()
                    ->placeholder('Pilih produk...'),
                
                Filter::make('created_at')
                    ->label('Tanggal Review')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Review dari ' . \Carbon\Carbon::parse($data['created_from'])->format('d/m/Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Review sampai ' . \Carbon\Carbon::parse($data['created_until'])->format('d/m/Y');
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->action(function (Review $record) {
                        try {
                            $record->delete();
                            Notification::make()
                                ->title('Review berhasil dihapus')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error')
                                ->body('Terjadi error saat menghapus review')
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Review Terpilih')
                        ->action(function ($records) {
                            try {
                                $records->each->delete();
                                Notification::make()
                                    ->title('Review berhasil dihapus')
                                    ->body(count($records) . ' review telah dihapus')
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Error')
                                    ->body('Terjadi error saat menghapus review')
                                    ->danger()
                                    ->send();
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Belum ada review')
            ->emptyStateDescription('Review dari customer akan muncul di sini.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right')
            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Buat Review')
                    ->url(route('filament.admin.resources.reviews.create'))
                    ->icon('heroicon-o-plus')
                    ->button(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['customer', 'product'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
            'view' => Pages\ViewReview::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}

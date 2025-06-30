<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Item Pesanan';

    protected static ?string $modelLabel = 'Item Pesanan';

    protected static ?string $pluralModelLabel = 'Item Pesanan';

    protected static ?string $navigationGroup = 'Operasional';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'dalam_proses')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Item')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('order_id')
                                    ->label('Pesanan')
                                    ->relationship('order', 'order_code')
                                    ->searchable()
                                    ->required()
                                    ->disabled(fn (string $context): bool => $context === 'edit'),
                                
                                Select::make('product_id')
                                    ->label('Produk')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->required()
                                    ->disabled(fn (string $context): bool => $context === 'edit'),
                                
                                TextInput::make('price')
                                    ->label('Harga per Hari')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required()
                                    ->disabled(fn (string $context): bool => $context === 'edit'),
                                
                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required()
                                    ->disabled(fn (string $context): bool => $context === 'edit'),
                            ]),
                    ]),

                Section::make('Jadwal Rental')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('started_at')
                                    ->label('Tanggal Mulai')
                                    ->required()
                                    ->disabled(fn (string $context): bool => $context === 'edit'),
                                
                                DatePicker::make('ended_at')
                                    ->label('Tanggal Selesai')
                                    ->required()
                                    ->disabled(fn (string $context): bool => $context === 'edit'),
                            ]),
                    ]),

                Section::make('Status Item')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'dalam_proses' => 'Dalam Proses',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'dibatalkan') {
                                    $set('cancellation_reason', '');
                                }
                            }),
                        Textarea::make('cancellation_reason')
                            ->label('Alasan Pembatalan')
                            ->rows(3)
                            ->visible(fn (callable $get): bool => $get('status') === 'dibatalkan')
                            ->required(fn (callable $get): bool => $get('status') === 'dibatalkan'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('product.thumbnail')
                    ->label('Produk')
                    ->circular()
                    ->size(40),
                TextColumn::make('product.name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                TextColumn::make('order.order_code')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->url(fn (OrderItem $record): string => route('filament.admin.resources.orders.view', $record->order)),
                TextColumn::make('order.customer.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('rental_period')
                    ->label('Periode Rental')
                    ->getStateUsing(function (OrderItem $record): string {
                        return $record->started_at->format('d M Y') . ' - ' . $record->ended_at->format('d M Y');
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('started_at', $direction);
                    }),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'dalam_proses',
                        'success' => 'selesai',
                        'danger' => 'dibatalkan',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dalam_proses' => 'Dalam Proses',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                        default => $state,
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'dalam_proses' => 'Dalam Proses',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ]),
                
                Filter::make('active_rentals')
                    ->label('Rental Aktif')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('status', 'dalam_proses')
                        ->where('started_at', '<=', now())
                        ->where('ended_at', '>=', now())
                    )
                    ->toggle(),
                
                Filter::make('upcoming_rentals')
                    ->label('Rental Mendatang')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('status', 'dalam_proses')
                        ->where('started_at', '>', now())
                    )
                    ->toggle(),
                
                Filter::make('overdue_rentals')
                    ->label('Rental Terlambat')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('status', 'dalam_proses')
                        ->where('ended_at', '<', now())
                    )
                    ->toggle(),
                
                SelectFilter::make('order_id')
                    ->label('Pesanan')
                    ->relationship('order', 'order_code')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('mark_completed')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (OrderItem $record): bool => $record->status === 'dalam_proses')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Item Selesai')
                    ->modalDescription('Apakah Anda yakin ingin menandai item ini sebagai selesai? Kendaraan telah dikembalikan dan diperiksa.')
                    ->modalSubmitActionLabel('Ya, Tandai Selesai')
                    ->modalCancelActionLabel('Batal')
                    ->action(function (OrderItem $record) {
                        $record->update(['status' => 'selesai']);
                        
                        Notification::make()
                            ->title('Item berhasil ditandai selesai')
                            ->body('Kendaraan telah dikembalikan dan diperiksa.')
                            ->success()
                            ->send();
                    }),
                
                Action::make('mark_cancelled')
                    ->label('Tandai Dibatalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (OrderItem $record): bool => $record->status === 'dalam_proses')
                    ->form([
                        Textarea::make('cancellation_reason')
                            ->label('Alasan Pembatalan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan alasan pembatalan item...'),
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Item Dibatalkan')
                    ->modalDescription('Apakah Anda yakin ingin menandai item ini sebagai dibatalkan?')
                    ->modalSubmitActionLabel('Ya, Tandai Dibatalkan')
                    ->modalCancelActionLabel('Batal')
                    ->action(function (OrderItem $record, array $data) {
                        $record->update([
                            'status' => 'dibatalkan',
                            'cancellation_reason' => $data['cancellation_reason'],
                        ]);
                        
                        Notification::make()
                            ->title('Item berhasil ditandai dibatalkan')
                            ->body('Item telah dibatalkan dengan alasan yang diberikan.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Action::make('bulk_complete')
                        ->label('Tandai Selesai Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Tandai Item Selesai Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menandai semua item terpilih sebagai selesai?')
                        ->modalSubmitActionLabel('Ya, Tandai Selesai')
                        ->modalCancelActionLabel('Batal')
                        ->action(function ($records) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->status === 'dalam_proses') {
                                    $record->update(['status' => 'selesai']);
                                    $count++;
                                }
                            }
                            
                            Notification::make()
                                ->title("{$count} item berhasil ditandai selesai")
                                ->success()
                                ->send();
                        }),
                    
                    Action::make('bulk_cancel')
                        ->label('Tandai Dibatalkan Terpilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->form([
                            Textarea::make('cancellation_reason')
                                ->label('Alasan Pembatalan')
                                ->required()
                                ->rows(3)
                                ->placeholder('Masukkan alasan pembatalan untuk semua item terpilih...'),
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Tandai Item Dibatalkan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin menandai semua item terpilih sebagai dibatalkan?')
                        ->modalSubmitActionLabel('Ya, Tandai Dibatalkan')
                        ->modalCancelActionLabel('Batal')
                        ->action(function ($records, array $data) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->status === 'dalam_proses') {
                                    $record->update([
                                        'status' => 'dibatalkan',
                                        'cancellation_reason' => $data['cancellation_reason'],
                                    ]);
                                    $count++;
                                }
                            }
                            
                            Notification::make()
                                ->title("{$count} item berhasil ditandai dibatalkan")
                                ->success()
                                ->send();
                        }),
                    
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            ->with(['order.customer', 'product']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            'view' => Pages\ViewOrderItem::route('/{record}'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}

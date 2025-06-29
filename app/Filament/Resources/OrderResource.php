<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $activeNavigationIcon = 'heroicon-s-book-open';

    protected static ?string $navigationLabel = 'Pesanan';

    protected static ?string $breadcrumb = 'Pesanan';

    protected static ?string $label = 'List Pesanan';

    protected static ?string $navigationGroup = 'Operasional';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereIn('status', ['menunggu_verifikasi', 'dalam_proses'])->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pesanan')
                    ->schema([
                        Forms\Components\TextInput::make('order_code')
                            ->label('Kode Pesanan')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Select::make('customer_id')
                            ->label('Pelanggan')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'menunggu_verifikasi' => 'Menunggu Verifikasi',
                                'diverifikasi' => 'Terverifikasi - Menunggu Pembayaran',
                                'dalam_proses' => 'Dalam Proses - Menyiapkan Kendaraan',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('cancellation_reason')
                            ->label('Alasan Pembatalan')
                            ->visible(fn (string $context): bool => $context === 'edit')
                            ->rows(3),
                    ])->columns(2),

                Forms\Components\Section::make('Informasi Pengiriman')
                    ->schema([
                        Forms\Components\Toggle::make('is_delivered')
                            ->label('Dikirim ke Alamat')
                            ->default(true),
                        Forms\Components\TextInput::make('delivery_fee')
                            ->label('Biaya Pengiriman')
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\Textarea::make('delivery_location')
                            ->label('Lokasi Pengiriman')
                            ->rows(3),
                        Forms\Components\Textarea::make('pickup_location')
                            ->label('Lokasi Pengambilan')
                            ->rows(3),
                    ])->columns(2),

                Forms\Components\Section::make('Informasi Pembayaran')
                    ->schema([
                        Forms\Components\Select::make('discount_id')
                            ->label('Diskon')
                            ->relationship('discount', 'name')
                            ->searchable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Jumlah Item')
                    ->counts('items')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->getStateUsing(fn (Order $record): float => $record->payment?->gross_amount ?? 0)
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'menunggu_verifikasi',
                        'info' => 'diverifikasi',
                        'primary' => 'dalam_proses',
                        'success' => 'selesai',
                        'danger' => 'dibatalkan',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'diverifikasi' => 'Terverifikasi - Menunggu Pembayaran',
                        'dalam_proses' => 'Dalam Proses - Menyiapkan Kendaraan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'diverifikasi' => 'Terverifikasi - Menunggu Pembayaran',
                        'dalam_proses' => 'Dalam Proses - Menyiapkan Kendaraan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ]),
                Tables\Filters\Filter::make('pending_verification')
                    ->label('Menunggu Verifikasi')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'menunggu_verifikasi'))
                    ->toggle(),
                Tables\Filters\Filter::make('needs_attention')
                    ->label('Perlu Perhatian Admin')
                    ->query(fn (Builder $query): Builder => $query->whereIn('status', ['menunggu_verifikasi', 'dalam_proses']))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->status === 'menunggu_verifikasi')
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin memverifikasi pesanan ini? Setelah diverifikasi, pelanggan dapat melakukan pembayaran.')
                    ->modalSubmitActionLabel('Ya, Verifikasi')
                    ->modalCancelActionLabel('Batal')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'diverifikasi']);
                        
                        Notification::make()
                            ->title('Pesanan berhasil diverifikasi')
                            ->body('Pelanggan sekarang dapat melakukan pembayaran.')
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Order $record): bool => $record->status === 'menunggu_verifikasi')
                    ->form([
                        Forms\Components\Textarea::make('cancellation_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan alasan penolakan pesanan...'),
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin menolak pesanan ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Tolak')
                    ->modalCancelActionLabel('Batal')
                    ->action(function (Order $record, array $data) {
                        $record->update([
                            'status' => 'dibatalkan',
                            'cancellation_reason' => $data['cancellation_reason'],
                            'cancelled_at' => now(),
                        ]);
                        
                        Notification::make()
                            ->title('Pesanan berhasil ditolak')
                            ->body('Pesanan telah dibatalkan dan pelanggan akan diberitahu.')
                            ->success()
                            ->send();
                    }),
                Action::make('complete')
                    ->label('Selesaikan')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn (Order $record): bool => $record->status === 'dalam_proses')
                    ->requiresConfirmation()
                    ->modalHeading('Selesaikan Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin menyelesaikan pesanan ini? Kendaraan telah siap dan dapat diserahkan kepada pelanggan.')
                    ->modalSubmitActionLabel('Ya, Selesaikan')
                    ->modalCancelActionLabel('Batal')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'selesai']);
                        
                        Notification::make()
                            ->title('Pesanan berhasil diselesaikan')
                            ->body('Kendaraan telah siap dan dapat diserahkan kepada pelanggan.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Action::make('bulk_verify')
                        ->label('Verifikasi Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Verifikasi Pesanan Terpilih')
                        ->modalDescription('Apakah Anda yakin ingin memverifikasi semua pesanan terpilih?')
                        ->modalSubmitActionLabel('Ya, Verifikasi')
                        ->modalCancelActionLabel('Batal')
                        ->action(function ($records) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->status === 'menunggu_verifikasi') {
                                    $record->update(['status' => 'diverifikasi']);
                                    $count++;
                                }
                            }
                            
                            Notification::make()
                                ->title("{$count} pesanan berhasil diverifikasi")
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
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class PendingVerificationOrders extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->where('status', 'menunggu_verifikasi')
                    ->with(['customer', 'items.product'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Pesanan')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Jumlah Item')
                    ->counts('items'),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->money('IDR')
                    ->getStateUsing(fn (Order $record): float => $record->payment?->gross_amount ?? 0),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
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
                    ->form([
                        \Filament\Forms\Components\Textarea::make('cancellation_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3)
                            ->placeholder('Masukkan alasan penolakan pesanan...'),
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Pesanan')
                    ->modalDescription('Apakah Anda yakin ingin menolak pesanan ini?')
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
                            ->success()
                            ->send();
                    }),
                Action::make('view')
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Order $record): string => route('filament.admin.resources.orders.view', $record)),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }

    protected function getTableHeading(): string
    {
        return 'Pesanan Menunggu Verifikasi';
    }
} 
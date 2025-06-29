<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\KeyValue;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pesanan')
                    ->schema([
                        TextEntry::make('order_code')
                            ->label('Kode Pesanan')
                            ->copyable(),
                        TextEntry::make('customer.name')
                            ->label('Nama Pelanggan'),
                        TextEntry::make('customer.email')
                            ->label('Email Pelanggan'),
                        TextEntry::make('phone_number')
                            ->label('Nomor Telepon'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'menunggu_verifikasi' => 'warning',
                                'diverifikasi' => 'info',
                                'dalam_proses' => 'primary',
                                'selesai' => 'success',
                                'dibatalkan' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'menunggu_verifikasi' => 'Menunggu Verifikasi',
                                'diverifikasi' => 'Terverifikasi - Menunggu Pembayaran',
                                'dalam_proses' => 'Dalam Proses - Menyiapkan Kendaraan',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                                default => $state,
                            }),
                        TextEntry::make('created_at')
                            ->label('Tanggal Pesanan')
                            ->dateTime('d M Y H:i'),
                        TextEntry::make('cancelled_at')
                            ->label('Tanggal Pembatalan')
                            ->dateTime('d M Y H:i')
                            ->visible(fn ($record) => $record->cancelled_at !== null),
                        TextEntry::make('cancellation_reason')
                            ->label('Alasan Pembatalan')
                            ->badge()
                            ->color('warning')
                            ->visible(fn ($record) => $record->cancellation_reason !== null)
                    ])
                    ->columns(2),

                Section::make('Data Pesanan')
                    ->schema([
                        RepeatableEntry::make('items')
                        ->label('')
                            ->schema([
                                TextEntry::make('product.thumbnail')
                                    ->label('Gambar')
                                    ->html()
                                    ->formatStateUsing(function ($state) {
                                        if ($state) {
                                            return '<img src="' . Storage::disk('s3')->url($state) . '" class="w-48 h-48 object-cover rounded-lg" />';
                                        }
                                        return '<div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">-</div>';
                                    }),
                                TextEntry::make('product.name')
                                    ->label('Nama Produk'),
                                TextEntry::make('started_at')
                                    ->label('Tanggal Mulai')
                                    ->dateTime('d M Y'),
                                TextEntry::make('ended_at')
                                    ->label('Tanggal Selesai')
                                    ->dateTime('d M Y'),
                                TextEntry::make('price')
                                    ->label('Harga Harian')
                                    ->money('IDR'),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->money('IDR'),
                            ])
                            ->columns(6)
                            ->contained(false),
                    ]),

                Section::make('Informasi Pengiriman')
                    ->schema([
                        TextEntry::make('is_delivered')
                            ->label('Dikirim ke Alamat')
                            ->formatStateUsing(fn ($state) => $state ? 'Ya' : 'Tidak'),
                        TextEntry::make('delivery_fee')
                            ->label('Biaya Pengiriman')
                            ->money('IDR')
                            ->visible(fn ($record) => $record->delivery_fee > 0),
                        TextEntry::make('delivery_location')
                            ->label('Lokasi Pengiriman')
                            ->formatStateUsing(function ($state) {
                                if (!$state) return 'Tidak tersedia';
                                $location = json_decode($state, true);
                                if (!$location) return 'Format tidak valid';

                                switch ($location['type'] ?? '') {
                                    case 'existing':
                                        return
                                            ($location['name'] ?? '-') . '<br>' .
                                            ($location['address'] ?? '-') . '<br>' .
                                            ($location['city'] ?? '-') . ', ' .
                                            ($location['province'] ?? '-') . ' ' .
                                            ($location['postal_code'] ?? '');
                                    case 'new':
                                        return
                                            ($location['name'] ?? '-') . '<br>' .
                                            ($location['address_detail'] ?? '-') . '<br>' .
                                            ($location['city'] ?? '-') . ', ' .
                                            ($location['province'] ?? '-') . ' ' .
                                            ($location['postal_code'] ?? '');
                                    case 'pickup':
                                        return 'Ambil di Lokasi: ' . ($location['location'] ?? 'Alamat Perusahaan');
                                    default:
                                        return 'Format tidak dikenali';
                                }
                            })
                            ->html()
                            ->visible(fn ($record) => $record->delivery_location !== null),
                        TextEntry::make('pickup_location')
                            ->label('Lokasi Pengambilan')
                            ->visible(fn ($record) => $record->pickup_location !== null),
                    ])
                    ->columns(2),

                Section::make('Informasi Pembayaran')
                    ->schema([
                        TextEntry::make('total_amount')
                            ->label('Total Pembayaran')
                            ->money('IDR')
                            ->size('lg')
                            ->weight('bold')
                            ->getStateUsing(function (Order $record): string {
                                $payment = $record->payment;
                                if (!$payment) {
                                    return 'Rp 0';
                                }
                                
                                $subtotal = $record->items->sum('subtotal');
                                $tax = $subtotal * 0.11;
                                $calculatedTotal = $subtotal + $tax;
                                
                                return 'Rp ' . number_format($calculatedTotal, 0, ',', '.') . 
                                    '<br><span class="text-sm text-gray-500">(Subtotal: Rp ' . number_format($subtotal, 0, ',', '.') . 
                                    ' + Pajak(11%) : Rp ' . number_format($tax, 0, ',', '.') . ')</span>';
                            })
                            ->html(),
                        TextEntry::make('discount.percentage')
                            ->label('Persentase Diskon')
                            ->suffix('%')
                            ->visible(fn ($record) => $record->discount !== null),
                    ])
                    ->columns(2),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('verify')
                ->label('Verifikasi')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status === 'menunggu_verifikasi')
                ->requiresConfirmation()
                ->modalHeading('Verifikasi Pesanan')
                ->modalDescription('Apakah Anda yakin ingin memverifikasi pesanan ini? Setelah diverifikasi, pelanggan dapat melakukan pembayaran.')
                ->modalSubmitActionLabel('Ya, Verifikasi')
                ->modalCancelActionLabel('Batal')
                ->action(function () {
                    $this->record->update(['status' => 'diverifikasi']);
                    
                    Notification::make()
                        ->title('Pesanan berhasil diverifikasi')
                        ->body('Pelanggan sekarang dapat melakukan pembayaran.')
                        ->success()
                        ->send();
                                    
                    $this->redirect(static::getResource()::getUrl('index'));
                }),
            Actions\Action::make('reject')
                ->label('Tolak')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => $this->record->status === 'menunggu_verifikasi')
                ->form([
                    \Filament\Forms\Components\Textarea::make('cancellation_reason')
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
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => 'dibatalkan',
                        'cancellation_reason' => $data['cancellation_reason'],
                        'cancelled_at' => now(),
                    ]);
                    
                    Notification::make()
                        ->title('Pesanan berhasil ditolak')
                        ->body('Pesanan telah dibatalkan dan pelanggan akan diberitahu.')
                        ->success()
                        ->send();
                    
                    $this->redirect(static::getResource()::getUrl('index'));
                }),
            Actions\Action::make('complete')
                ->label('Selesaikan')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->visible(fn () => $this->record->status === 'dalam_proses')
                ->requiresConfirmation()
                ->modalHeading('Selesaikan Pesanan')
                ->modalDescription('Apakah Anda yakin ingin menyelesaikan pesanan ini? Kendaraan telah siap dan dapat diserahkan kepada pelanggan.')
                ->modalSubmitActionLabel('Ya, Selesaikan')
                ->modalCancelActionLabel('Batal')
                ->action(function () {
                    $this->record->update(['status' => 'selesai']);
                    
                    Notification::make()
                        ->title('Pesanan berhasil diselesaikan')
                        ->body('Kendaraan telah siap dan dapat diserahkan kepada pelanggan.')
                        ->success()
                        ->send();
                    
                    $this->redirect(static::getResource()::getUrl('index'));
                }),
        ];
    }
} 
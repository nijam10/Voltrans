<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use Filament\Notifications\Notification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        // Send notification to all admin users when a new order is created
        if ($order->status === 'menunggu_verifikasi') {
            $adminUsers = User::where('role', 'admin')->get();
            
            foreach ($adminUsers as $admin) {
                Notification::make()
                    ->title('Pesanan Baru Menunggu Verifikasi')
                    ->body("Pesanan {$order->order_code} dari {$order->customer->name} memerlukan verifikasi.")
                    ->icon('heroicon-o-clock')
                    ->color('warning')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('view')
                            ->label('Lihat Pesanan')
                            ->url(route('filament.admin.resources.orders.view', $order))
                            ->button(),
                    ])
                    ->sendToDatabase($admin);
            }
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Check if status changed to pending verification
        if ($order->wasChanged('status') && $order->status === 'menunggu_verifikasi') {
            $adminUsers = User::where('role', 'admin')->get();
            
            foreach ($adminUsers as $admin) {
                Notification::make()
                    ->title('Pesanan Menunggu Verifikasi')
                    ->body("Pesanan {$order->order_code} telah diperbarui dan memerlukan verifikasi.")
                    ->icon('heroicon-o-clock')
                    ->color('warning')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('view')
                            ->label('Lihat Pesanan')
                            ->url(route('filament.admin.resources.orders.view', $order))
                            ->button(),
                    ])
                    ->sendToDatabase($admin);
            }
        }

        // Check if status changed to diverifikasi (verified)
        if ($order->wasChanged('status') && $order->status === 'diverifikasi') {
            // Notify the customer that their order has been verified
            Notification::make()
                ->title('Pesanan Telah Diverifikasi! 🎉')
                ->body("Pesanan {$order->order_code} telah diverifikasi oleh admin. Silakan lakukan pembayaran untuk melanjutkan proses rental.")
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->actions([
                    \Filament\Notifications\Actions\Action::make('pay_now')
                        ->label('Bayar Sekarang')
                        ->url(route('checkout.payment', ['order_code' => $order->order_code]))
                        ->button(),
                    \Filament\Notifications\Actions\Action::make('view_order')
                        ->label('Lihat Pesanan')
                        ->url(route('user.orders.show', $order))
                        ->button(),
                ])
                ->sendToDatabase($order->customer);
        }

        // Check if status changed to dalam_proses (payment successful, admin needs to prepare)
        if ($order->wasChanged('status') && $order->status === 'dalam_proses') {
            // Notify admin that payment is successful and car needs to be prepared
            $adminUsers = User::where('role', 'admin')->get();
            
            foreach ($adminUsers as $admin) {
                Notification::make()
                    ->title('Pembayaran Berhasil - Siapkan Kendaraan! 🚗')
                    ->body("Pesanan {$order->order_code} telah dibayar. Silakan siapkan kendaraan untuk rental.")
                    ->icon('heroicon-o-truck')
                    ->color('primary')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('view_order')
                            ->label('Lihat Pesanan')
                            ->url(route('filament.admin.resources.orders.view', $order))
                            ->button(),
                    ])
                    ->sendToDatabase($admin);
            }

            // Notify customer that payment is successful and car is being prepared
            Notification::make()
                ->title('Pembayaran Berhasil! 💳')
                ->body("Pembayaran untuk pesanan {$order->order_code} berhasil. Tim kami sedang menyiapkan kendaraan Anda.")
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view_order')
                        ->label('Lihat Pesanan')
                        ->url(route('user.orders.show', $order))
                        ->button(),
                ])
                ->sendToDatabase($order->customer);
        }

        // Check if status changed to selesai (completed)
        if ($order->wasChanged('status') && $order->status === 'selesai') {
            // Notify customer that their rental is ready
            Notification::make()
                ->title('Rental Siap! 🚗✨')
                ->body("Kendaraan untuk pesanan {$order->order_code} telah siap. Silakan ambil kendaraan Anda sesuai dengan jadwal yang telah ditentukan.")
                ->icon('heroicon-o-truck')
                ->color('success')
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view_order')
                        ->label('Lihat Pesanan')
                        ->url(route('user.orders.show', $order))
                        ->button(),
                ])
                ->sendToDatabase($order->customer);
        }

        // Check if status changed to dibatalkan (rejected)
        if ($order->wasChanged('status') && $order->status === 'dibatalkan') {
            // Notify the customer that their order has been rejected
            Notification::make()
                ->title('Pesanan Ditolak')
                ->body("Pesanan {$order->order_code} telah ditolak oleh admin. Silakan hubungi customer service untuk informasi lebih lanjut.")
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view_order')
                        ->label('Lihat Detail')
                        ->url(route('user.orders.show', $order))
                        ->button(),
                ])
                ->sendToDatabase($order->customer);
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
} 
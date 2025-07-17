<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\User;
use Filament\Notifications\Notification;

class AddressObserver
{
    /**
     * Handle the Address "created" event.
     */
    public function created(Address $address): void
    {
        // Notify all admin users when a new address needs verification
        if ($address->isPendingVerification()) {
            $adminUsers = User::where('role', 'admin')->get();
            foreach ($adminUsers as $admin) {
                Notification::make()
                    ->title('Alamat Baru Menunggu Verifikasi')
                    ->body("Alamat baru dari {$address->user->name} memerlukan verifikasi KTP.")
                    ->icon('heroicon-o-map')
                    ->color('warning')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('view')
                            ->label('Lihat Alamat')
                            ->url(route('filament.admin.resources.addresses.edit', $address))
                            ->button(),
                    ])
                    ->sendToDatabase($admin);
            }
        }
    }

    /**
     * Handle the Address "updated" event.
     */
    public function updated(Address $address): void
    {
        // Notify admins if address status changes to pending verification (resubmission)
        if ($address->wasChanged(['ktp_path', 'rejection_reason', 'is_verified']) && $address->isPendingVerification()) {
            $adminUsers = User::where('role', 'admin')->get();
            foreach ($adminUsers as $admin) {
                Notification::make()
                    ->title('Pengajuan Ulang Alamat Menunggu Verifikasi')
                    ->body("Alamat dari {$address->user->name} diajukan ulang dan memerlukan verifikasi KTP.")
                    ->icon('heroicon-o-map')
                    ->color('warning')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('view')
                            ->label('Lihat Alamat')
                            ->url(route('filament.admin.resources.addresses.view', $address))
                            ->button(),
                    ])
                    ->sendToDatabase($admin);
            }
        }

        // Notify user if address is verified
        if ($address->wasChanged('is_verified') && $address->is_verified) {
            Notification::make()
                ->title('Alamat Terverifikasi!')
                ->body('Alamat Anda telah berhasil diverifikasi oleh admin. Anda sekarang dapat melakukan pemesanan.')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view')
                        ->label('Lihat Alamat')
                        ->url(route('user.addresses.index'))
                        ->button(),
                ])
                ->sendToDatabase($address->user);
        }

        // Notify user if address is rejected
        if ($address->wasChanged('rejection_reason') && !$address->is_verified && !empty($address->rejection_reason)) {
            Notification::make()
                ->title('Verifikasi Alamat Ditolak')
                ->body('Verifikasi alamat Anda ditolak. Alasan: ' . $address->rejection_reason)
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view')
                        ->label('Lihat Alamat')
                        ->url(route('user.addresses.index'))
                        ->button(),
                ])
                ->sendToDatabase($address->user);
        }
    }
} 
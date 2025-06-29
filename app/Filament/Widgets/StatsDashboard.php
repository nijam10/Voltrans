<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;

use Carbon\Carbon;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $pendingVerification = Order::where('status', 'menunggu_verifikasi')->count();
        $totalCustomers = User::where('role', 'customer')->count();        
        // Calculate total revenue from completed orders
        $totalRevenue = Payment::where('payment_status', 'paid')->sum('gross_amount');
        
        // Orders from last 30 days
        $recentOrders = Order::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        
        // New customers from last 30 days
        $newCustomers = User::where('role', 'customer')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();

        return [
            Stat::make('Total Pemasukan', 'Rp' . number_format($totalRevenue, 0, ',', '.'))
                ->description($recentOrders . ' pesanan 30 hari terakhir')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Menunggu Verifikasi', $pendingVerification)
                ->description('Pesanan yang perlu diverifikasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->url(route('filament.admin.resources.orders.index', ['tableFilters[status][value]' => 'menunggu_verifikasi'])),
            
            Stat::make('Total Customer', $totalCustomers)
                ->description($newCustomers . ' customer baru 30 hari terakhir')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
            
            Stat::make('Total Pesanan', $totalOrders)
                ->description($recentOrders . ' pesanan 30 hari terakhir')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),
        ];
    }
}

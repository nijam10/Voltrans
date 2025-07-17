<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\Order;
use App\Observers\OrderObserver;
use App\Models\Address;
use App\Observers\AddressObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Register observers
        Order::observe(OrderObserver::class);
        Address::observe(AddressObserver::class);
    }
}

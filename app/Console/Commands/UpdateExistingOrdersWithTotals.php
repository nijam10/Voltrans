<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class UpdateExistingOrdersWithTotals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update-totals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all existing orders with calculated subtotal, tax, shipping, and total fields';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::with('items.product.category')->get();
        $bar = $this->output->createProgressBar($orders->count());
        $bar->start();

        foreach ($orders as $order) {
            $order->calculateAndUpdateTotals();
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nAll orders updated with new totals.");
    }
}

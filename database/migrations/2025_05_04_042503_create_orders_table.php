<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('customer_id')
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products', 'id')
                ->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('order_method')->enum('Ambil di toko', 'Antar ke lokasi');
            $table->string('pickup_address')->nullable();
            $table->decimal('delivery_fee', 10, 2)->nullable();
            $table->string('delivery_address')->nullable();
            $table->decimal('total_price', 10, 2);            
            $table->string('status')->enum('Tertunda', 'Diproses', 'Selesai', 'Dibatalkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

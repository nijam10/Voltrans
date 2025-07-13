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
            $table->string('phone_number');
            $table->unsignedInteger('shipping_fee')->default(0); // New field for calculated shipping fee
            $table->unsignedInteger('subtotal')->default(0); // New field for order subtotal
            $table->unsignedInteger('tax_amount')->default(0); // New field for tax amount
            $table->unsignedInteger('total_amount')->default(0); // New field for total amount
            $table->boolean('is_delivered')->default(true);
            $table->string('delivery_location')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->enum('status', ['menunggu_verifikasi', 'diverifikasi', 'dalam_proses', 'selesai', 'dibatalkan']);
            $table->softDeletes();
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

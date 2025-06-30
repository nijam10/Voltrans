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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders', 'id')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products', 'id')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('subtotal');
            $table->date('started_at');
            $table->date('ended_at');
            $table->enum('status', ['dalam_proses', 'selesai', 'dibatalkan']);
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

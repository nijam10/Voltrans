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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                ->constrained('users', 'id')
                ->cascadeOnDelete();
            $table->string('order_code');
            $table->foreign('order_code')
                    ->references('order_code')
                    ->on('orders')
                    ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products', 'id')
                ->cascadeOnDelete();
            $table->integer('rating')->default(0);
            $table->text('review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

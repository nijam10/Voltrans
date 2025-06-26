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
            $table->foreignId('discount_id')
                ->nullable()
                ->constrained('discounts', 'id')
                ->cascadeOnDelete();
            $table->string('phone_number');
            $table->unsignedInteger('delivery_fee')->nullable();
            $table->boolean('is_delivered')->default(true);
            $table->string('pickup_location')->nullable();
            $table->string('delivery_location')->nullable();
            $table->unsignedBigInteger('total_amount');
            $table->text('cancellation_reason')->nullable();
            $table->enum('status', ['dalam_proses', 'selesai', 'dibatalkan']);
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

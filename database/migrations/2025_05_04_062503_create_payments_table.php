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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->string('order_code');
            $table->foreign('order_code')
                ->references('order_code')
                ->on('orders')
                ->cascadeOnDelete();
            $table->string('payment_method')->default('bank_transfer');
            $table->enum('payment_status', ['Tertunda', 'Selesai', 'Gagal'])->default('Tertunda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

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
        Schema::create('order_item_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')
                ->constrained()
                ->onDelete('cascade');
            $table->enum('status', [
                'dalam_proses',
                'dikirim',
                'ambil_pesanan',
                'sedang_disewa',
                'selesai',
                'dibatalkan'
            ]);
            $table->timestamp('changed_at')
                ->nullable();
            $table->text('note')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_status_histories');
    }
};

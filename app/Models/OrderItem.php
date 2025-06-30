<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'subtotal',
        'started_at',
        'ended_at',
        'status',
        'cancellation_reason',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
        'price' => 'integer',
        'subtotal' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    /**
     * Get the status label for the order item
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'dalam_proses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => 'Tidak Diketahui'
        };
    }

    /**
     * Get the status color for the order item
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'dalam_proses' => 'yellow',
            'selesai' => 'green',
            'dibatalkan' => 'red',
            default => 'gray'
        };
    }

    /**
     * Get the status icon for the order item
     */
    public function getStatusIconAttribute(): string
    {
        return match($this->status) {
            'dalam_proses' => 'clock',
            'selesai' => 'check-circle',
            'dibatalkan' => 'x-circle',
            default => 'question-circle'
        };
    }

    /**
     * Check if the item is currently active (within rental period)
     */
    public function isCurrentlyActive(): bool
    {
        $now = now();
        return $this->started_at <= $now && $this->ended_at >= $now && $this->status === 'dalam_proses';
    }

    /**
     * Check if the item is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'selesai';
    }

    /**
     * Check if the item is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'dibatalkan';
    }

    /**
     * Get the rental duration in days
     */
    public function getRentalDurationAttribute(): int
    {
        return $this->started_at->diffInDays($this->ended_at) + 1;
    }

    /**
     * Get the remaining days for active rentals
     */
    public function getRemainingDaysAttribute(): ?int
    {
        if (!$this->isCurrentlyActive()) {
            return null;
        }
        
        return now()->diffInDays($this->ended_at, false);
    }
}

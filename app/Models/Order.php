<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_code',
        'customer_id',
        'phone_number',
        'product_id',
        'is_delivered',
        'discount_id',
        'delivery_fee',
        'pickup_location',
        'delivery_location',
        'return_location',
        'total_amount',
        'cancellation_reason',
        'started_at',
        'ended_at',
        'status',
    ];

    protected $casts = [
        'total_amount' => MoneyCast::class,
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function generateOrderCode()
    {
        $prefix = 'VOL';
        do {
            $code = $prefix . strtoupper(uniqid());
        } while (self::where('order_code', $code)->exists());

        return $code;
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

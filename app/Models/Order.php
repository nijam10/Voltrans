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
        'is_delivered',
        'discount_id',
        'delivery_fee',
        'pickup_location',
        'delivery_location',
        'cancellation_reason',
        'cancelled_at',
        'status',
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
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

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_code', 'order_code');
    }

    public function getTotalAmountAttribute()
    {
        return $this->payment?->gross_amount ?? 0;
    }

    public function getStatusLabelAttribute()
    {
        $statusLabels = [
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'diverifikasi' => 'Terverifikasi',
            'dalam_proses' => 'Dalam Proses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ];

        return $statusLabels[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

}

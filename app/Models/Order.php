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
        'shipping_fee',
        'subtotal',
        'tax_amount',
        'total_amount',
        'delivery_location',
        'cancellation_reason',
        'cancelled_at',
        'status',
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
        'shipping_fee' => 'integer',
        'subtotal' => 'integer',
        'tax_amount' => 'integer',
        'total_amount' => 'integer',
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
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_code', 'order_code');
    }

    /**
     * Calculate shipping fee based on vehicle type and delivery method
     */
    public function calculateShippingFee(): int
    {
        if (!$this->is_delivered) {
            return 0; // No shipping fee for pickup
        }

        $shippingFee = 0;
        $vehicleCount = 0;

        foreach ($this->items as $item) {
            $vehicleCount++;
            $category = $item->product->category;
            
            if ($category) {
                $categoryName = strtolower($category->name);
                
                // Electric cars: 50,000 per vehicle
                if (str_contains($categoryName, 'mobil') && str_contains($categoryName, 'listrik')) {
                    $shippingFee += 50000;
                }
                // Motorcycles and scooters: 25,000 per vehicle
                elseif (str_contains($categoryName, 'motor') || str_contains($categoryName, 'skuter')) {
                    $shippingFee += 25000;
                }
                // Default for other vehicles: 25,000 per vehicle
                else {
                    $shippingFee += 25000;
                }
            } else {
                // Default fee if category is not found
                $shippingFee += 25000;
            }
        }

        return $shippingFee;
    }

    /**
     * Calculate order totals and update the order
     */
    public function calculateAndUpdateTotals(): void
    {
        $subtotal = $this->items->sum('subtotal');
        $shippingFee = $this->calculateShippingFee();
        $taxAmount = $subtotal * 0.11; // 11% tax
        $totalAmount = $subtotal + $taxAmount + $shippingFee;

        $this->update([
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
        ]);
    }

    /**
     * Get total amount - use calculated total if available, otherwise fallback to payment amount
     */
    public function getTotalAmountAttribute()
    {
        if (array_key_exists('total_amount', $this->attributes)) {
            return $this->attributes['total_amount'];
        }
        return $this->payment?->gross_amount ?? 0;
    }

    /**
     * Get subtotal amount
     */
    public function getSubtotalAmountAttribute()
    {
        if ($this->subtotal > 0) {
            return $this->subtotal;
        }
        
        return $this->items->sum('subtotal');
    }

    /**
     * Get tax amount
     */
    public function getTaxAmountAttribute()
    {
        if (array_key_exists('tax_amount', $this->attributes)) {
            return $this->attributes['tax_amount'];
        }
        return $this->getSubtotalAmountAttribute() * 0.11;
    }

    /**
     * Get shipping fee amount
     */
    public function getShippingFeeAmountAttribute()
    {
        if ($this->shipping_fee > 0) {
            return $this->shipping_fee;
        }
        
        return $this->calculateShippingFee();
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

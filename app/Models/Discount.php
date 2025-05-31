<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'discount_type',
        'value',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'value' => 'decimal:2',
    ]; 

    /**
     * Calculate discount amount based on order total
     * 
     * @param float $orderTotal - The total order amount
     * @return float - The discount amount
     */
    public function calculateDiscountAmount(float $orderTotal): float
    {
        if ($this->discount_type === 'percentage') {
            // For percentage: value contains the percentage (e.g., 15 for 15%)
            return ($orderTotal * $this->value) / 100;
        } else {
            // For nominal: value contains the fixed amount (e.g., 25.00 for $25 off)
            // Make sure discount doesn't exceed order total
            return min($this->value, $orderTotal);
        }
    }

    /**
     * Calculate final total after discount
     * 
     * @param float $orderTotal - The original order total
     * @return array - Contains discount amount and final total
     */
    public function applyToOrder(float $orderTotal): array
    {
        $discountAmount = $this->calculateDiscountAmount($orderTotal);
        $finalTotal = $orderTotal - $discountAmount;

        return [
            'original_total' => $orderTotal,
            'discount_amount' => $discountAmount,
            'final_total' => max(0, $finalTotal), // Ensure total never goes below 0
            'discount_type' => $this->discount_type,
            'discount_value' => $this->value,
            // Formatted IDR currency
            'original_total_formatted' => $this->formatIDR($orderTotal),
            'discount_amount_formatted' => $this->formatIDR($discountAmount),
            'final_total_formatted' => $this->formatIDR(max(0, $finalTotal))
        ];
    }

    /**
     * Format number to Indonesian Rupiah currency
     * 
     * @param float $amount
     * @return string
     */
    public function formatIDR(float $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    /**
     * Check if discount is currently valid (simple check)
     * 
     * @return bool
     */
    public function isValid(): bool
    {
        $now = now();
        return $this->is_active 
            && $this->valid_from <= $now 
            && $this->valid_until >= $now;
    }
}

<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'order_id',
        'user_id',
        'method',
        'amount',
        'status',
    ];

    protected $casts = [
        'amount' => MoneyCast::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}

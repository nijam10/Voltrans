<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemStatusHistory extends Model
{

    protected $fillable = ['order_item_id', 'status', 'changed_at', 'note'];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }   
}

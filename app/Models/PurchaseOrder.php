<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'order_number',
        'supplier_id',
        'user_id',
        'status',
        'order_date',
        'expected_date',
        'received_date',
        'total_amount',
        'notes'
    ];

    protected $casts = [
        'order_date' => 'date',
        'expected_date' => 'date',
        'received_date' => 'date',
        'total_amount' => 'decimal:2'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function scopePending($query): mixed
    {
        return $query->where('status', 'pending');
    }

    public function scopeOrdered($query): mixed
    {
        return $query->where('status', 'ordered');
    }

    public function scopeReceived($query): mixed
    {
        return $query->where('status', 'received');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($purchaseOrder): void {
            if (empty($purchaseOrder->order_number)) {
                $purchaseOrder->order_number = 'PO-' . date('Y') . '-' . str_pad(static::whereYear('created_at', date('Y'))->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}

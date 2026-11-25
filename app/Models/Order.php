<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const PENDING_PAYMENT = 'pending_payment';

    public const PAID = 'paid';

    protected $fillable = [
        'user_id',
        'order_number',
        'region',
        'status',
        'total_amount',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'integer',
            'expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentProofs(): HasMany
    {
        return $this->hasMany(PaymentProof::class);
    }
}

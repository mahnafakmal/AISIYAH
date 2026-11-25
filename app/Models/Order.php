<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'order_number', 'region', 'status', 'total_amount', 'expires_at'])]
class Order extends Model
{
    public const PENDING_PAYMENT = 'pending_payment';

    public const AWAITING_APPROVAL = 'awaiting_approval';

    public const PAID = 'paid';

    public const PAYMENT_REJECTED = 'payment_rejected';

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

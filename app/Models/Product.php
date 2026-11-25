<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public const CATEGORIES = [
        'skincare' => 'Skincare',
        'makanan' => 'Makanan',
        'kebersihan' => 'Kebersihan',
    ];

    protected $fillable = [
        'created_by',
        'name',
        'category',
        'description',
        'price',
        'discount_percent',
        'discount_starts_at',
        'discount_ends_at',
        'image_path',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'discount_percent' => 'integer',
            'discount_starts_at' => 'datetime',
            'discount_ends_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function activeDiscountPercent(): ?int
    {
        if ($this->discount_percent === null) {
            return null;
        }

        $now = now();

        if ($this->discount_starts_at !== null && $this->discount_starts_at->gt($now)) {
            return null;
        }

        if ($this->discount_ends_at !== null && $this->discount_ends_at->lt($now)) {
            return null;
        }

        return $this->discount_percent;
    }

    public function priceWithDiscount(?int $discountPercent): int
    {
        if ($discountPercent === null) {
            return $this->price;
        }

        return max(1, intdiv($this->price * (100 - $discountPercent), 100));
    }

    public function currentPrice(): int
    {
        return $this->priceWithDiscount($this->activeDiscountPercent());
    }

    public function isPromoActive(): bool
    {
        return $this->activeDiscountPercent() !== null;
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

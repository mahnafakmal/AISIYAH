<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['created_by', 'name', 'category', 'description', 'price', 'image_path', 'is_active'])]
class Product extends Model
{
    public const CATEGORIES = [
        'skincare' => 'Skincare',
        'makanan' => 'Makanan',
        'kebersihan' => 'Kebersihan',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

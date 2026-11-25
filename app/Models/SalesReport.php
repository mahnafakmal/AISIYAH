<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesReport extends Model
{
    protected $fillable = ['user_id', 'region', 'period', 'file_path', 'remarks'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

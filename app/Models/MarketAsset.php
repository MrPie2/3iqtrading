<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketAsset extends Model
{
    protected $fillable = ['symbol', 'name', 'price', 'change_percent', 'category'];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'change_percent' => 'decimal:2',
        ];
    }
}

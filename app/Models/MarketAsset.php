<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketAsset extends Model
{
    protected $table = 'market_assets';
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'price' => 'float',
        'change_percent' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

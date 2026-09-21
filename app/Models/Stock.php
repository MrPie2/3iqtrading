<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Unit' => 'float',
        'MarketCap' => 'float',
        'Spread' => 'float',
        'Trend' => 'float',
        'timeframe' => 'integer',
        'dayToLoad' => 'integer',
    ];
}

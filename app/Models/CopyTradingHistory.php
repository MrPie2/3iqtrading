<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CopyTradingHistory extends Model
{
    protected $table = 'copy_trading_history';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'amount_deposit' => 'integer',
        'return_on_copying' => 'integer',
        'stoploss' => 'integer',
        'status' => 'integer',
    ];
}

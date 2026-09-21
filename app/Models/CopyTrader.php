<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CopyTrader extends Model
{
    protected $table = 'copy_traders';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'minimum_deposit' => 'integer',
        'amount_invested' => 'integer',
        'return_on_copying' => 'integer',
        'total_investors' => 'integer',
        'leverage' => 'integer',
        'fees' => 'integer',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockContract extends Model
{
    protected $table = 'stockcontracts';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Margin' => 'float',
        'Status' => 'integer',
    ];
}

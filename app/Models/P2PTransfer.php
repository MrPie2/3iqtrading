<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class P2PTransfer extends Model
{
    protected $table = 'P2P';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Amount' => 'integer',
        'Status' => 'integer',
        'Date' => 'datetime',
    ];
}

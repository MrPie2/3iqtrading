<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cryptocurrency extends Model
{
    protected $table = 'cryptocurrencies';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

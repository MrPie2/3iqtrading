<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardOrder extends Model
{
    protected $table = 'cardorders';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Status' => 'integer',
    ];
}

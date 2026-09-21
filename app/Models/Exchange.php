<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = 'exchange';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

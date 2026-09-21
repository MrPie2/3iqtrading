<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CacheEntry extends Model
{
    protected $table = 'cache';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'expiration' => 'integer',
    ];
}

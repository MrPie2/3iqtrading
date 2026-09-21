<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CacheLock extends Model
{
    protected $table = 'cache_locks';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'expiration' => 'integer',
    ];
}

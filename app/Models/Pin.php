<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    protected $table = 'Pin';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

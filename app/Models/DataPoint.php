<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPoint extends Model
{
    protected $table = 'data';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
    ];
}

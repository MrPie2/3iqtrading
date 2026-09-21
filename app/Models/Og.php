<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Og extends Model
{
    protected $table = 'og';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

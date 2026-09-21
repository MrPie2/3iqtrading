<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $table = 'Investments';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Contract_Start' => 'datetime',
        'Timer' => 'integer',
        'PrevSettled' => 'integer',
        'Remaining' => 'integer',
        'Status' => 'integer',
    ];
}

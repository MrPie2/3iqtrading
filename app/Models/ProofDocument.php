<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProofDocument extends Model
{
    protected $table = 'ProofDoc';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Date' => 'datetime',
    ];
}

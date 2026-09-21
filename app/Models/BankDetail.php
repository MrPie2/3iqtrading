<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $table = 'bankdetails';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

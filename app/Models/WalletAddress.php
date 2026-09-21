<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletAddress extends Model
{
    protected $table = 'walletaddress';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

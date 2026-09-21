<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndividualWalletAddress extends Model
{
    protected $table = 'individual_walletaddress';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    protected $table = 'card_details';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
        'Investor_id' => 'integer',
        'Amount' => 'integer',
        'CVC' => 'integer',
        'Pin' => 'integer',
    ];
}

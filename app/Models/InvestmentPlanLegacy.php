<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlanLegacy extends Model
{
    protected $table = 'investmentplans';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'id' => 'integer',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    protected $table = 'investment_plans';

    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'minimum_amount' => 'float',
        'maximum_amount' => 'float',
        'illustrative_rate' => 'float',
        'featured' => 'boolean',
        'features' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

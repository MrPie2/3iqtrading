<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    protected $table = 'investment_plans';
    protected $fillable = [
        'name', 'minimum_amount', 'maximum_amount', 'term_label',
        'risk_level', 'illustrative_rate', 'description', 'features', 'featured',
    ];

    protected function casts(): array
    {
        return [
            'minimum_amount' => 'decimal:2',
            'maximum_amount' => 'decimal:2',
            'illustrative_rate' => 'decimal:2',
            'features' => 'array',
            'featured' => 'boolean',
        ];
    }
}

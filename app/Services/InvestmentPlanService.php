<?php

namespace App\Services;

use App\Models\InvestmentPlan;

class InvestmentPlanService
{
    public function featured()
    {
        return InvestmentPlan::query()
            ->where('featured', true)
            ->orderBy('minimum_amount')
            ->get();
    }

    public function all()
    {
        return InvestmentPlan::query()->orderBy('minimum_amount')->get();
    }
}

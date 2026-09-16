<?php

namespace App\Http\Controllers;

use App\Services\FaqService;
use App\Services\InvestmentPlanService;
use App\Services\MarketChartService;
use Illuminate\View\View;
use App\Models\Faq;
use App\Models\InvestmentPlan;
class HomeController extends Controller
{
    public function __construct(
        private readonly InvestmentPlanService $plans,
        private readonly FaqService $faqs,
        private readonly MarketChartService $market,
    ) {}

    public function index(): View
    {
          $faqs=Faq::all();
        $plans = InvestmentPlan::all();

        return view('pages.home', [
            'plans' => $this->plans->featured(),
            'faqs' => $this->faqs->active(),
            'market' => $this->market->snapshot(),
            'chart' => $this->market->chartSeries(),
            'plans' => $plans,
            'faqs' => $faqs
        ]);
    }
}

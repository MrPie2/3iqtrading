<?php

namespace App\Http\Controllers;

use App\Services\InvestmentPlanService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(private readonly InvestmentPlanService $plans) {}

    public function services(): View
    {
        return view('pages.services');
    }

    public function ira(): View
    {
        return view('pages.ira');
    }

    public function stocks(): View
    {
        return view('pages.stocks');
    }

    public function fourOhOneK(): View
    {
        return view('pages.401k');
    }

    public function shares(): View
    {
        return view('pages.shares', ['plans' => $this->plans->all()]);
    }
}

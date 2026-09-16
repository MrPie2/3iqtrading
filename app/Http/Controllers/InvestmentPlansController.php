<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvestmentPlan;

class InvestmentPlansController extends Controller
{
    public function investmentplans(){
        $plans=InvestmentPlan::all();
        return view('pages.home', compact('plans'));
    }
}

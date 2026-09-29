<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\InvestmentPlan;
use App\Models\InvestmentPlanLegacy;
use App\Models\Stock;
use App\Models\StockContract;
use App\Services\InvestmentPlanService;
use App\Services\InvestmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function plans()
    {
        $plans = app(InvestmentPlanService::class)->all();
        $investor = Auth::guard('investor')->user();

        return view('dashboard.investments.plans', compact('plans', 'investor'));
    }

    public function create(InvestmentPlan $plan)
    {
        return view('dashboard.investments.create', [
            'plan' => $plan,
            'investor' => Auth::guard('investor')->user(),
        ]);
    }

    public function store(Request $request, InvestmentService $service)
    {
        $data = $request->validate([
            'plan_id' => ['required', 'integer', 'exists:investment_plans,id'],
            'amount' => ['required', 'numeric', 'gt:0'],
        ]);

        $investor = Auth::guard('investor')->user();
        $plan = InvestmentPlan::query()->findOrFail($data['plan_id']);

        try {
            $contract = $service->createPlanInvestment($investor, $plan, (float) $data['amount']);

            return response()->json([
                'ok' => true,
                'message' => 'Investment started successfully.',
                'contract_id' => $contract->Contract_id,
                'redirect' => route('investments.contracts'),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'ok' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function contracts()
    {
        $investor = Auth::guard('investor')->user();
        $contracts = Contract::where('Investor_id', $investor->Investor_id)->latest('id')->get();

        return view('dashboard.investments.contracts', compact('contracts', 'investor'));
    }

    public function ira(InvestmentPlanService $planService)
    {
        $investor = Auth::guard('investor')->user();
        $plans = $planService->all();

        return view('dashboard.ira.index', compact('investor', 'plans'));
    }

    public function iraSavings()
    {
        $investor = Auth::guard('investor')->user();
        $iraSavings = (float) ($investor->IRA_Savings ?? 0);
        $iraContributions = (float) ($investor->IRA_Contributions ?? 0);
        $iraGrowth = (float) ($investor->IRA_Growth ?? 0);
        $iraGoal = (float) ($investor->IRA_Goal ?? 0);
        $iraProgress = $iraGoal > 0 ? min(100, ($iraSavings / $iraGoal) * 100) : 0;

        return view('dashboard.ira.savings', compact('investor', 'iraSavings', 'iraContributions', 'iraGrowth', 'iraGoal', 'iraProgress'));
    }

    public function stockMarket()
    {
        $investor = Auth::guard('investor')->user();
        $stocks = Stock::orderBy('CompanyName')->get();

        return view('dashboard.market.index', compact('stocks', 'investor'));
    }

    public function stock(Stock $stock)
    {
        return view('dashboard.market.stock', compact('stock'))
            ->with('investor', Auth::guard('investor')->user());
    }

    public function applyStock(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string',
            'plan_type' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'buy_price' => 'required|numeric',
            'buy_position' => 'required|numeric',
            'total_units' => 'required|numeric',
            'duration' => 'required|integer|min:1',
        ]);

        $investor = Auth::guard('investor')->user();
        $amount = $data['amount'] / max((float) $investor->exchangerate, 0.000001);

        if ($amount > (float) $investor->Total_Deposit) {
            return response()->json(['ok' => false, 'message' => 'Insufficient available balance.'], 422);
        }

        DB::transaction(function () use ($data, $investor, $amount) {
            StockContract::create([
                'Investor_id' => $investor->Investor_id,
                'Contract_id' => random_int(10000000, 999999999),
                'CompanyName' => $data['company_name'],
                'Plan_Type' => $data['plan_type'],
                'Amount' => $amount,
                'Buy_Price' => $data['buy_price'],
                'Buy_Position' => $data['buy_position'],
                'Margin' => 1.000,
                'Total_Units' => $data['total_units'],
                'Date_Entered' => now()->format('l d F Y'),
                'Contract_Duration' => $data['duration'],
                'Status' => 1,
            ]);
            $investor->decrement('Total_Deposit', $amount);
        });

        return response()->json(['ok' => true, 'message' => 'Stock position created.', 'redirect' => route('dashboard')]);
    }
}

<?php
namespace App\Http\Controllers;
use App\Models\Contract;
use App\Models\InvestmentPlanLegacy;
use App\Models\Stock;
use App\Models\StockContract;
use App\Services\InvestmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function plans(){
        $plans=InvestmentPlanLegacy::orderBy('id')->get();
        return view('investments.plans',compact('plans'));
    }
    public function create(InvestmentPlanLegacy $plan){
        return view('investments.create',compact('plan'));
    }
    public function store(Request $request, InvestmentService $service){
        $data=$request->validate([
            'plan_type'=>'required|string|max:255','amount'=>'required|numeric|min:0.01',
            'duration'=>'required|integer|min:1|max:3650','percentage'=>'nullable|numeric',
        ]);
        $investor=Auth::guard('investor')->user();
        try{
            $contract=$service->createPlanInvestment($investor,$data);
            return response()->json(['ok'=>true,'message'=>'Investment placed successfully.','contract_id'=>$contract->Contract_id,'redirect'=>route('dashboard')]);
        }catch(\Throwable $e){
            return response()->json(['ok'=>false,'message'=>$e->getMessage()],422);
        }
    }
    public function contracts(){
        $investor=Auth::guard('investor')->user();
        $contracts=Contract::where('Investor_id',$investor->Investor_id)->latest('id')->get();
        return view('investments.contracts',compact('contracts'));
    }
    public function stockMarket(){
        $stocks=Stock::orderBy('CompanyName')->get();
        return view('market.index',compact('stocks'));
    }
    public function stock(Stock $stock){ return view('market.stock',compact('stock')); }
    public function applyStock(Request $request){
        $data=$request->validate([
            'company_name'=>'required|string','plan_type'=>'required|string',
            'amount'=>'required|numeric|min:0.01','buy_price'=>'required|numeric',
            'buy_position'=>'required|numeric','total_units'=>'required|numeric','duration'=>'required|integer|min:1'
        ]);
        $investor=Auth::guard('investor')->user();
        $amount=$data['amount']/(float)$investor->exchangerate;
        if($amount>(float)$investor->Total_Deposit) return response()->json(['ok'=>false,'message'=>'Insufficient available balance.'],422);
        DB::transaction(function() use($data,$investor,$amount){
            StockContract::create([
                'Investor_id'=>$investor->Investor_id,'Contract_id'=>random_int(10000000,999999999),
                'CompanyName'=>$data['company_name'],'Plan_Type'=>$data['plan_type'],'Amount'=>$amount,
                'Buy_Price'=>$data['buy_price'],'Buy_Position'=>$data['buy_position'],'Margin'=>1.000,
                'Total_Units'=>$data['total_units'],'Date_Entered'=>now()->format('l d F Y'),
                'Contract_Duration'=>$data['duration'],'Status'=>1
            ]);
            $investor->decrement('Total_Deposit',$amount);
        });
        return response()->json(['ok'=>true,'message'=>'Stock position created.','redirect'=>route('dashboard')]);
    }
}

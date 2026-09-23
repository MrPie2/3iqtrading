<?php
namespace App\Http\Controllers;
use App\Models\Investor;
use App\Models\P2PTransfer;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index(){
        $investor=Auth::guard('investor')->user();
        $transfers=P2PTransfer::where('Transferer',$investor->Investor_id)->orWhere('Receiver',$investor->Investor_id)->latest('id')->get();
        return view('dashboard.transfers.index',compact('investor','transfers'));
    }
    public function verifyReceiver(Request $request){
        $request->validate(['receiver'=>'required|string']);
        $receiver=Investor::where('Investor_id',$request->receiver)->first();
        return response()->json(['ok'=>(bool)$receiver,'name'=>$receiver?->First_Name,'message'=>$receiver?'Receiver found.':'Receiver not found.'], $receiver?200:422);
    }
    public function create(Request $request){
        $data=$request->validate(['amount'=>'required|numeric|min:0.01','receiver'=>'required|string','receiver_name'=>'nullable|string','type'=>'nullable|string']);
        $investor=Auth::guard('investor')->user();
        if((float)$data['amount']>(float)$investor->Total_Deposit) return response()->json(['ok'=>false,'message'=>'Insufficient available balance.'],422);
        P2PTransfer::create(['Transferer'=>$investor->Investor_id,'Receiver'=>$data['receiver'],'Name'=>$data['receiver_name']??'','Amount'=>$data['amount'],'Type'=>$data['type']??'Account','Type2'=>'Transfer','Status'=>0]);
        return response()->json(['ok'=>true,'message'=>'Transfer initiated successfully.']);
    }
    public function confirm(Request $request){
        $data=$request->validate(['amount'=>'required|numeric','receiver'=>'required|string','transferer'=>'required|string']);
        return DB::transaction(function() use($data){
            $receiver=Investor::where('Investor_id',$data['receiver'])->lockForUpdate()->firstOrFail();
            $transferer=Investor::where('Investor_id',$data['transferer'])->lockForUpdate()->firstOrFail();
            if($data['amount']>(float)$transferer->Total_Deposit) return response()->json(['ok'=>false,'message'=>'Transferer has insufficient balance.'],422);
            $transferer->decrement('Total_Deposit',$data['amount']); $receiver->increment('Total_Deposit',$data['amount']);
            P2PTransfer::where('Transferer',$transferer->Investor_id)->where('Receiver',$receiver->Investor_id)->where('Status',0)->update(['Status'=>1]);
            return response()->json(['ok'=>true,'message'=>'Transaction confirmed successfully.']);
        });
    }
    public function referralTransfer(Request $request){
        $investor=Auth::guard('investor')->user(); $amount=(float)$request->input('amount');
        $earned=Referral::where('Refferer',$investor->Investor_id)->where('Status',1)->sum('Refferal_Earnings');
        if($amount<=0 || $amount>$earned) return response()->json(['ok'=>false,'message'=>'Invalid referral amount.'],422);
        DB::transaction(function() use($investor,$amount){ $investor->increment('Fin_Asset',$amount/max((float)$investor->exchangerate,0.000001)); Referral::where('Refferer',$investor->Investor_id)->where('Status',1)->update(['Status'=>2]); });
        return response()->json(['ok'=>true,'message'=>'Referral earnings transferred to portfolio.']);
    }
}
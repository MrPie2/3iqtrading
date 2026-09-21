<?php
namespace App\Http\Controllers;
use App\Models\BankDetail;
use App\Models\Deposit;
use App\Models\ProofDocument;
use App\Models\Investor;
use App\Models\WalletAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index(){
        $investor=Auth::guard('investor')->user();
        $banks=BankDetail::where('Investor_id',$investor->Investor_id)->latest('id')->get();
        $proofs=ProofDocument::where('Investor_id',$investor->Investor_id)->latest('id')->get();
        $deposits=Deposit::where('Investor_id',$investor->Investor_id)->latest('id')->get();
        $wallets=WalletAddress::latest('id')->get();
        return view('wallet.index',compact('investor','banks','proofs','deposits','wallets'));
    }
    public function addBank(Request $request){
        $data=$request->validate(['account_name'=>'required|string|max:255','account_number'=>'required|string|max:255','bank_name'=>'required|string|max:255','routing_number'=>'nullable|string|max:255']);
        $investor=Auth::guard('investor')->user();
        $bank=BankDetail::create(['Investor_id'=>$investor->Investor_id,'Bank_Name'=>$data['bank_name'],'Account_Name'=>$data['account_name'],'Account_Number'=>$data['account_number'],'RoutingNumber'=>$data['routing_number']??'']);
        return response()->json(['ok'=>true,'message'=>'Bank added successfully.','id'=>$bank->id]);
    }
    public function uploadProof(Request $request){
        $request->validate(['proof_image'=>'required|image|mimes:jpg,jpeg,png,gif|max:5120']);
        $investor=Auth::guard('investor')->user();
        $path=$request->file('proof_image')->store('deposit-proofs','public');
        ProofDocument::create(['Investor_id'=>$investor->Investor_id,'Proof_Picture'=>$path,'Date'=>now()]);
        return response()->json(['ok'=>true,'message'=>'Upload successful.']);
    }
}

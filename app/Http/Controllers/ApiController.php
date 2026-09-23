<?php
namespace App\Http\Controllers;
use App\Models\AuthorizationToken;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ApiController extends Controller
{
    public function checkToken(Request $request){
        $row=AuthorizationToken::where('Investor_id',Auth::guard('investor')->user()->Investor_id)->where('token',$request->input('token'))->where('status',0)->first();
        return response()->json(['ok'=>(bool)$row,'token'=>$row?->token]);
    }
    public function checkPin(Request $request){
        $investor=Auth::guard('investor')->user();
        $valid=(string)$investor->Transaction_Pin===(string)$request->input('pin');
        return response()->json(['ok'=>$valid]);
    }
    public function receiver(Request $request){
        $receiver=Investor::where('Investor_id',$request->input('receiver'))->first();
        return response()->json(['ok'=>(bool)$receiver,'name'=>$receiver?->First_Name],$receiver?200:422);
    }
}
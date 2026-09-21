<?php
namespace App\Http\Controllers;
use App\Models\Investor;
use App\Models\AuthorizationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ApiController extends Controller
{
    public function checkToken(Request $request){
        $token=$request->input('token');
        $row=AuthorizationToken::where('Investor_id',Auth::guard('investor')->user()->Investor_id)->where('token',$token)->where('status',0)->first();
        return response()->json(['ok'=>(bool)$row,'token'=>$row?->token]);
    }
    public function checkPin(Request $request){
        $investor=Auth::guard('investor')->user();
        return response()->json(['ok'=>isset($investor->PIN) && hash_equals((string)$investor->PIN,(string)$request->input('pin'))]);
    }
    public function receiver(Request $request){ return app(\App\Http\Controllers\TransferController::class)->verifyReceiver($request); }
}

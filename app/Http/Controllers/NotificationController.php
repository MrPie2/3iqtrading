<?php
namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function index(){
        $investor=Auth::guard('investor')->user();
        $notifications=Notification::where('Investor_id',$investor->Investor_id)->latest('id')->paginate(20);
        return view('notifications.index',compact('notifications'));
    }
    public function seen(Request $request){
        $request->validate(['id'=>'required|integer']);
        $updated=Notification::where('id',$request->id)->where('Investor_id',Auth::guard('investor')->user()->Investor_id)->update(['seen'=>1]);
        return response()->json(['ok'=>(bool)$updated]);
    }
}

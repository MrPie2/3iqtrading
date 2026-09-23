<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){ return view('dashboard.profile.index',['investor'=>Auth::guard('investor')->user()]); }
    public function update(Request $request){
        $data=$request->validate(['full_name'=>'required|string|max:255','email'=>'required|email|max:255','phone'=>'required|string|max:255']);
        $investor=Auth::guard('investor')->user();
        $investor->update(['First_Name'=>$data['full_name'],'Email'=>$data['email'],'Phone'=>$data['phone']]);
        return response()->json(['ok'=>true,'message'=>'Details updated successfully.']);
    }
    public function currency(Request $request){
        $data=$request->validate(['currency'=>'required|numeric','cur_name'=>'required|string|max:255','cur_abbr'=>'required|string|max:10']);
        Auth::guard('investor')->user()->update(['exchangerate'=>$data['currency'],'curName'=>$data['cur_name'],'curAbbr'=>$data['cur_abbr']]);
        return response()->json(['ok'=>true]);
    }
    public function image(Request $request){
        $request->validate(['user_image'=>'required|image|mimes:jpg,jpeg,png,gif|max:5120']);
        $investor=Auth::guard('investor')->user();
        $path=$request->file('user_image')->store('profile-pictures','public');
        $investor->update(['Profile_Picture'=>$path]);
        return response()->json(['ok'=>true,'message'=>'Display picture updated.','path'=>$path]);
    }
    public function changePassword(Request $request){
        $data=$request->validate(['password'=>'required|min:6','email'=>'required|email']);
        $investor=Auth::guard('investor')->user();
        if(strcasecmp((string)$investor->Email,$data['email'])!==0) return response()->json(['ok'=>false,'message'=>'Email does not match your account.'],422);
        $investor->update(['Password'=>Hash::make($data['password'])]);
        return response()->json(['ok'=>true,'message'=>'Password updated successfully.']);
    }
}
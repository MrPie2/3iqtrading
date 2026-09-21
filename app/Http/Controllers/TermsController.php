<?php
namespace App\Http\Controllers;
use App\Models\Page;
class TermsController extends Controller
{
    public function show(){
        $page=Page::where(function($q){$q->where('Page_Name','like','%term%')->orWhere('Page_Name','like','%condition%');})->first();
        return view('legacy.terms',compact('page'));
    }
}

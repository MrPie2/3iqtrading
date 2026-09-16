<?php

namespace App\Http\Controllers;
use App\Models\Faq;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    
    public function faq(){
        $faqs=Faq::latest()->get();
        return view('manager.admin.faq', compact('faqs'));
    }
 
}

<?php
namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    public function show()
    {
        $page = Page::where(function ($q) {
            $q->where('Page_Name', 'like', '%term%')
              ->orWhere('Page_Name', 'like', '%condition%');
        })->first();

        return view('dashboard.legacy.terms', [
            'page' => $page,
            'investor' => Auth::guard('investor')->user(),
        ]);
    }
}
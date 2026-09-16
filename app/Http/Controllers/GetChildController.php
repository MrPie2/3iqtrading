<?php

namespace App\Http\Controllers;
use App\Models\Pages;
use Illuminate\Http\Request;

class GetChildController extends Controller
{
    public function getchild_of(Request $request)
    {
        $pages = Pages::all();
        $options = '';
        foreach ($pages as $page) {
            $options .= '<option value="'. $page->id .'">'.$page->Page_Name.'</option>';
        }
        return response()->json($options);
    }
}

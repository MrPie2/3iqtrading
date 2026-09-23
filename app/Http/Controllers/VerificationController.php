<?php

namespace App\Http\Controllers;

use App\Models\VerificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function index()
    {
        return view('dashboard.verification.index', ['investor' => Auth::guard('investor')->user()]);
    }

    public function upload(Request $request)
    {
        $data = $request->validate([
            'level' => 'required|string|max:255',
            'verification_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

        $path = $request->file('verification_image')->store('verification-docs', 'public');

        VerificationDocument::create([
            'Investor_id' => Auth::guard('investor')->user()->Investor_id,
            'DocToVerify' => $path,
            'Level' => $data['level'],
            'Status' => 0,
        ]);

        return response()->json(['ok' => true, 'message' => 'Document uploaded.']);
    }
}
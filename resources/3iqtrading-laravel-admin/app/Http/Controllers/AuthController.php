<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required','string','max:255'],
            'password' => ['required','string'],
        ]);

        if (!Schema::hasTable('og')) {
            return back()->withErrors(['username' => 'The admin table (og) is not available. Configure the database first.'])->withInput();
        }

        $admin = DB::table('og')->where('Username', $credentials['username'])->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Phone/username or password is incorrect.'])->withInput();
        }

        $valid = Hash::check($credentials['password'], (string) ($admin->Password ?? ''))
            || hash_equals((string) ($admin->Password ?? ''), $credentials['password']);

        if (!$valid) {
            return back()->withErrors(['username' => 'Phone/username or password is incorrect.'])->withInput();
        }

        $request->session()->regenerate();
        $request->session()->put([
            'Boss_id' => $admin->id,
            'Phone' => $admin->Phone ?? null,
            'Boss_Name' => $admin->Boss_Name ?? $admin->Username ?? 'Administrator',
        ]);

        // Upgrade legacy plaintext passwords after a successful login.
        try {
            if (isset($admin->Password) && $admin->Password === $credentials['password']) {
                DB::table('og')->where('id', $admin->id)->update([
                    'Password' => Hash::make($credentials['password']),
                ]);
            }
        } catch (\Throwable) {
            // Keep login successful if the legacy column cannot be updated.
        }

        return redirect()->route('admin.dashboard');
    }
}

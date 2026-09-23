<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientAuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!$this->authService->login($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'The provided credentials are incorrect or the investor account is unavailable.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with('success', 'Welcome back to 3IQ Trading.');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'],
            'terms' => ['accepted'],
        ]);

        try {
            $investor = $this->authService->register($data);
        } catch (\Throwable $e) {
            return back()->withInput($request->except(['password', 'password_confirmation']))
                ->withErrors(['email' => $e->getMessage()]);
        }

        Auth::guard('investor')->login($investor);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Your 3IQ Trading account has been created.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('investor')->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
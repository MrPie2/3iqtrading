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

        if (! $this->authService->login($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'The provided credentials are incorrect.']);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Welcome back to 3IQ Trading.');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'terms' => ['accepted'],
        ]);

        unset($data['terms'], $data['password_confirmation']);
        $user = $this->authService->register($data);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Your 3IQ Trading account has been created.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

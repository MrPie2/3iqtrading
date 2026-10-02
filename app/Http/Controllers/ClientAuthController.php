<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\MailerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        $token = $this->authService->createVerificationToken($investor);

        try {
            $reference = '3IQ-' . strtoupper(substr(sha1($investor->id . now()->format('YmdHisv')), 0, 10));

            app(MailerService::class)->sendVerificationEmail(
                (string) $investor->Email,
                (string) ($investor->First_Name ?: 'Investor'),
                route('verification.email', ['token' => $token]),
                $reference
            );
        } catch (\Throwable $e) {
            Log::error('Account verification email failed.', [
                'investor_id' => $investor->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('login')->with(
                'error',
                'Your account was created, but the verification email could not be sent. Please contact support.'
            );
        }

        return redirect()->route('login')->with(
            'success',
            'Account created. Please check your email and click the verification button before signing in.'
        );
    }

    public function verifyEmail(string $token): RedirectResponse
    {
        if (!$this->authService->verifyEmail($token)) {
            return redirect()->route('login')->with(
                'error',
                'This verification link is invalid or has expired.'
            );
        }

        return redirect()->route('login')->with(
            'success',
            'Your email has been verified. You can now sign in.'
        );
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

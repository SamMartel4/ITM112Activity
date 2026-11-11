<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Unique key for email and IP address
        $key = strtolower($request->email) . '|' . $request->ip();

        // Check if login is locked
        if (RateLimiter::tooManyAttempts($key, 5)) {

            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'email' => 'Too many login attempts.'
            ])->with('lockout_seconds', $seconds)
              ->onlyInput('email');
        }

        // Check login credentials
        if (Auth::attempt($request->only('email', 'password'))) {

            RateLimiter::clear($key);

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // Record failed attempt for 5 minutes
        RateLimiter::hit($key, 300);

        // Check if fifth failed attempt is reached
        if (RateLimiter::tooManyAttempts($key, 5)) {

            return back()->withErrors([
                'email' => 'Too many login attempts.'
            ])->with('lockout_seconds', 300)
              ->onlyInput('email');
        }

        // Invalid credentials
        return back()->withErrors([
            'email' => 'Invalid email or password.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

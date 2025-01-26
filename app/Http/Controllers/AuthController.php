<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // validate
        $fields = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:3|confirmed'
        ]);

        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        // verify email
        event(new Registered($user));

        // Redirect
        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        // validate
        $fields = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        // Try to login
        if (Auth::attempt($fields, $request->remember)) {
            // return redirect()->route('dashboard');
            return redirect()->intended();
        } else {
            return back()->withErrors([
                'failed' => 'Invalid credentials'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard');
    }
}

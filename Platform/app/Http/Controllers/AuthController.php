<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function register(){
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register.registerOverview');
    }

    public function registerBrand(){
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register.registerBrand');
    }

    public function registerRetailer(){
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register.registerRetailer');
    }


    public function loginAction(Request $request)
    {
        // Validate incoming credentials
        $validated = $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string','min:6'],
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('storefront')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    public function logoutAction(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }

}

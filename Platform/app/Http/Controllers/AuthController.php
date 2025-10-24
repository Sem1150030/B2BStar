<?php

namespace App\Http\Controllers;

use Auth;
use App\Services\AuthService;
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


    public function loginAction(Request $request, AuthService $authService)
    {
        [$success, $message] = $authService->login($request);
        if ($success) {
            return redirect()->route('storefront')->with('success', $message);
        }
        return back()->withErrors([
            'email' => $message,
        ])->onlyInput('email');
    }

    public function logoutAction(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function registerBrandAction(Request $request, AuthService $authService)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:30',
            'finance_email' => 'required|email',
            'motto' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'password' => 'required|min:6|confirmed',
        ]);

        [$success, $message] = $authService->registerBrand($data);
        if ($success) {
            return redirect()->route('login')->with('success', $message);
        }
        return back()->withErrors(['register' => $message])->withInput();

    }

    public function registerRetailerAction(Request $request, AuthService $authService)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:30',
            'finance_email' => 'required|email',
            'country' => 'required|string|max:3',
            'description' => 'nullable|string|max:1000',
            'password' => 'required|min:6|confirmed',
        ]);

        [$success, $message] = $authService->registerRetailer($data);

        if ($success) {
            return redirect()->route('login')->with('success', $message);
        }
        return back()->withErrors(['register' => $message])->withInput();

    }

}

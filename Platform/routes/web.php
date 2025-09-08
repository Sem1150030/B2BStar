<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('marketplace.storefront');
});

Route::get('/lang/{locale}', function (string $locale, Request $request) {
    $allowed = ['en','nl','fr','de'];
    if (! in_array($locale, $allowed)) {
        abort(404);
    }
    session(['app_locale' => $locale]);
    // Also drop a long-lived cookie (1 year) so locale persists if session resets
    $minutes = 60 * 24 * 365; // 1 year
    $redirect = url()->previous();
    if ($redirect === url('/lang/'.$locale)) {
        $redirect = url('/');
    }
    Cookie::queue('app_locale', $locale, $minutes, '/');
    return redirect($redirect)->with('locale_changed', $locale);
});

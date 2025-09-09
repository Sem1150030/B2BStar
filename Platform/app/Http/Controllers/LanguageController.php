<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(string $locale, Request $request): \Illuminate\Http\RedirectResponse
    {
        $available = ['en', 'nl', 'fr', 'de'];
        if (! in_array($locale, $available)) {
            return redirect()->back();
        }
        $request->session()->put('app_locale', $locale);
        cookie()->queue('app_locale', $locale, 60 * 24 * 365, '/');

        return redirect()->back();
    }
}

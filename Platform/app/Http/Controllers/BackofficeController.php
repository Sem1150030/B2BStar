<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function dashboard()
    {
        if (!Gate::allows('access-backoffice')) {
            return redirect()->route('storefront')->with('error', 'You do not have access to the backoffice.');
        }
        return view('backoffice.dashboard');
    }

    public function products()
    {
        if (!Gate::allows('access-backoffice')) {
            return redirect()->route('storefront')->with('error', 'You do not have access to the backoffice.');
        }
        return view('backoffice.products.products');
    }
}

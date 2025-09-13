<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function storefront()
    {
        return view('marketplace.storefront');
    }
}

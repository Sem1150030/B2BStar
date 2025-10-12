<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
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

    public function createProduct()
    {
        if (!Gate::allows('access-backoffice')) {
            return redirect()->route('storefront')->with('error', 'You do not have access to the backoffice.');
        }
        return view('backoffice.products.create_product');
    }

    public function storeProduct($request){
        if (!Gate::allows('access-backoffice')) {
            return redirect()->route('storefront')->with('error', 'You do not have access to the backoffice.');
        }

        try {
            app(ProductsService::class)->createProduct($request);
            return redirect('backoffice/products')->with('success', 'Product created successfully.');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Validation failed. Please check your input.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating product: ' . $e->getMessage())->withInput();
        }
        catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Unexpected error: ' . $e->getMessage())->withInput();
        }
    }
}

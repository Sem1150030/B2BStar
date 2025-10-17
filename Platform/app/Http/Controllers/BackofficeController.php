<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductsService;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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

    public function editProduct($id){
        if (!Gate::allows('access-backoffice')) {
            return redirect()->route('storefront')->with('error', 'You do not have access to the backoffice.');
        }
        $product = Product::with('productImage', 'category', 'brand', 'variants')->where('brand_id', Auth::user()->role_id)->find($id);
        return view('backoffice.products.edit_product', ['product' => $product]);
    }

    public function deleteProductVariant($id){
        if (!Gate::allows('access-backoffice')) {
            return redirect()->route('storefront')->with('error', 'You do not have access to the backoffice.');
        }
        try {
            $variant = ProductVariant::with('productImage', 'product')->where('brand_id')->firstOrFail($id);
            if($variant->product->brand_id !== Auth::user()->role_id){
                return redirect()->route('storefront')->with('error', 'You do not have access to delete this variant.');
            }

            app(ProductsService::class)->deleteProductVariant($variant);
            return redirect()->back()->with('success', 'Product variant deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting product variant: ' . $e->getMessage());
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Unexpected error: ' . $e->getMessage());
        }
    }

    public function updateProduct($request, $id){
        if (!Gate::allows('access-backoffice')) {
            return redirect()->route('storefront')->with('error', 'You do not have access to the backoffice.');
        }
        try {
            app(ProductsService::class)->updateProduct($request, $id);
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Validation failed. Please check your input.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage())->withInput();
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Unexpected error: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('backoffice.products.edit', ['id' => $id])->with('info', 'Product update is handled in the edit form.');
    }
}

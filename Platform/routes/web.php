<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MarketplaceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;


Route::get('/', [MarketplaceController::class, 'storefront'])->name('storefront');

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'loginAction'])->name('login.action');
Route::post('/auth/logout', [AuthController::class, 'logoutAction'])->name('logout.action');

Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
Route::get('/auth/register/brand', [AuthController::class, 'registerBrand'])->name('register.brand');
Route::post('/auth/register/brand', [AuthController::class, 'registerBrandAction'])->name('register.brand.action');
Route::get('/auth/register/retailer', [AuthController::class, 'registerRetailer'])->name('register.retailer');




Route::middleware(['auth'])->group(function () {
    Route::get('/backoffice/dashboard', [BackofficeController::class, 'dashboard'])->name('backoffice.dashboard');
});

Route::get('/lang/{locale}',[LanguageController::class, 'switch'])->name('lang.switch');

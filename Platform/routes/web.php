<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('marketplace.storefront');
});


Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'loginAction'])->name('login.action');
Route::post('/auth/logout', [AuthController::class, 'logoutAction'])->name('logout.action');

Route::get('/lang/{locale}',[LanguageController::class, 'switch'])->name('lang.switch');

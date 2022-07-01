<?php

use Beike\Models\Customer;
use Beike\Shop\Http\Controllers\Account\AddressController;
use Illuminate\Support\Facades\Route;
use Beike\Shop\Http\Controllers\CartController;
use Beike\Shop\Http\Controllers\HomeController;
use Beike\Shop\Http\Controllers\PagesController;
use Beike\Shop\Http\Controllers\ProductController;
use Beike\Shop\Http\Controllers\CategoryController;
use Beike\Shop\Http\Controllers\CheckoutController;
use Beike\Shop\Http\Controllers\Account\LoginController;
use Beike\Shop\Http\Controllers\Account\LogoutController;
use Beike\Shop\Http\Controllers\Account\AccountController;
use Beike\Shop\Http\Controllers\Account\RegisterController;


Route::prefix('/')
    ->name('shop.')
    ->middleware(['web'])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home.index');

        Route::get('carts', [CartController::class, 'index'])->name('carts.index');
        Route::post('carts', [CartController::class, 'store'])->name('carts.store');
        Route::get('carts/mini', [CartController::class, 'miniCart'])->name('carts.mini');
        Route::put('carts/{cart}', [CartController::class, 'update'])->name('carts.update');
        Route::post('carts/select', [CartController::class, 'select'])->name('carts.select');
        Route::delete('carts/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');

        Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::put('checkout', [CheckoutController::class, 'update'])->name('checkout.update');

        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

        Route::get('login', [LoginController::class, 'index'])->name('login.index');
        Route::post('login', [LoginController::class, 'store'])->name('login.store');
        Route::get('register', [RegisterController::class, 'index'])->name('register.index');
        Route::post('register', [RegisterController::class, 'store'])->name('register.store');
        Route::get('logout', [LogoutController::class, 'index'])->name('logout');

        Route::middleware('shop_auth:' . Customer::AUTH_GUARD)
            ->group(function () {
                Route::get('account', [AccountController::class, 'index'])->name('account.index');

                Route::resource('account/addresses', AddressController::class);
            });

        Route::get('/{url_key}', [PagesController::class, 'show'])->name('pages.show');
    });

<?php

use App\Http\Controllers\InicioController;
use App\Http\Controllers\StripeCheckoutController;
use App\Livewire\ShoppingCart;
use App\Livewire\ShowShop;
use App\Livewire\ShowUserLibrary;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio'])->name('index');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/library', ShowUserLibrary::class)->name('library');
    Route::get('/shop', ShowShop::class)->name('shop');
    Route::get('/cart', ShoppingCart::class)->name('shopping-cart');
    // Rutas para manejar los pagos
    Route::get('/checkout', [ShoppingCart::class, 'startPayment'])->name('checkout');
    Route::get('/checkout/success', [StripeCheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [StripeCheckoutController::class, 'cancel'])->name('checkout.cancel');
});

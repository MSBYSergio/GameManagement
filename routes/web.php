<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\StripeCheckoutController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Livewire\ShoppingCart;
use App\Livewire\ShowGameDetails;
use App\Livewire\ShowShop;
use App\Livewire\ShowUserLibrary;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio'])->name('index');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contact'); // php artisan make:controller ContactoController
Route::post('/send', [ContactoController::class, 'send'])->name('contact.send');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/library', ShowUserLibrary::class)->name('library');
    Route::get('/shop', ShowShop::class)->name('shop');
    Route::get('/cart', ShoppingCart::class)->name('shopping-cart');
    Route::get('/game-details/{id}', ShowGameDetails::class)->name('game-details.show');
    Route::resource('tags', TagController::class)->middleware(IsAdminMiddleware::class);

    // -------------- INICIO: RUTAS PAGOS ----------------
    Route::get('/checkout', [ShoppingCart::class, 'startPayment'])->name('checkout');
    Route::get('/checkout/success', [StripeCheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [StripeCheckoutController::class, 'cancel'])->name('checkout.cancel');
    // -------------- FIN: RUTAS PAGOS ------------
});

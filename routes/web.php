<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\InicioController;
use App\Livewire\Cart;
use App\Livewire\ShowShop;
use App\Livewire\ShowUserLibrary;
use App\Models\Game;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'inicio'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/library', ShowUserLibrary::class)->name('library');
    Route::get('/shop', ShowShop::class)->name('shop');
    Route::get('/cart', Cart::class)->name('cart');
});

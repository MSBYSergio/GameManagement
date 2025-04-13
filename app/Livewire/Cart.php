<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public int $cantidad = 1;

    public function render()
    {
        $cart = app('cart')->session(Auth::id())->getContent();
        return view('livewire.cart', compact('cart'));
    }

    public function actualizarCantidad(int $id)
    {
        app('cart')->session(Auth::id())->update($id, array('quantity' => $this -> cantidad));
    }
}

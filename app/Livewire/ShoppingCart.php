<?php

namespace App\Livewire;

use App\Models\Game;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class ShoppingCart extends Component
{
    public function render()
    {
        $cart = Cart::instance(Auth::id())->content();
        return view('livewire.shopping-cart', compact('cart'));
    }

    public function startPayment()
    {
        Stripe::setApiKey(config('cashier.secret'));
        $cart = Cart::instance(Auth::id())->content(); // Contenido del carrito
        $games = []; // Array donde va a estar cada juego
        $lineItems = []; // Datos para Stripe

        if (count($cart) === 0) { // Muestro mensajería si el carrito está vacío.
            return redirect('/')->with('ERROR', "El carrito está vacío");
        }

        foreach ($cart as $item) { // Itero el carrito para quedarme con cada juego.
            $games[] = Game::findOrFail($item->id);
        }

        foreach ($games as $item) { // Indico que productos son los que se van a pagar
            $lineItems[] = [
                'price' => $item->stripe_price_id,
                'quantity' => 1,
            ];
        }

        $session = Session::create([ // Creo la sesión de pago de Stripe con el array que he creado antes
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => $lineItems,
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'automatic_tax' => [
                'enabled' => true, // <-- ¡Aquí activas el cálculo automático de impuestos!
            ],
            'cancel_url' => route('checkout.cancel'),
        ]);
        return redirect($session->url);
    }

    public function delete(string $rowId)
    {
        Cart::instance(Auth::id())->remove($rowId);
    }
}

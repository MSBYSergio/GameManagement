<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeCheckoutController extends Controller
{
    public function success(Request $request)
    {
        Stripe::setApiKey(config('cashier.secret'));
        $id = $request->get('session_id');
        $user = User::find(Auth::id());
        if (!$id) {
            return redirect('/')->with('mensaje', "Ups, algo ha salido mal");
        }
        $stripe = Session::allLineItems($id);
        foreach ($stripe->data as $item) {
            $stripePriceId = $item->price->id;
            $game = Game::where('stripe_price_id', $stripePriceId)->first();
            $user->games()->attach($game->id);
        }
        Cart::instance(Auth::id())->destroy();
        // Después de esto, mandar un email
        return view('checkout.success');
    }
    
    public function cancel()
    {
        return view('checkout.cancel');
    }
}

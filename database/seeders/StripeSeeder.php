<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;

class StripeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stripe::setApiKey(config('cashier.secret'));

        $games = Game::all();

        foreach ($games as $game) {
            $product = Product::create([ // Creo el producto en Stripe
                'name' => $game->name,
                'description' => $game->description,
            ]);

            $precioFinal = $game->discount ? $game->discount_price : $game->price;

            $price = Price::create([ // Creo el precio
                'unit_amount' => $precioFinal * 100,
                'currency' => 'eur',
                'product' => $product->id,
            ]);
            $game->update([ // Le doy valor a los ids con update
                'stripe_id' => $product->id,
                'stripe_price_id' => $price->id,
            ]);
        }
    }
}

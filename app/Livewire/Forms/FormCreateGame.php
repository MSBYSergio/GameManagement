<?php

namespace App\Livewire\Forms;

use App\Models\Game;
use Livewire\Form;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;

class FormCreateGame extends Form
{
    // Ten en cuenta que cuando insertas un juego aún no lo ha comprado ningún usuario.

    public string $name = '';
    public float $price = 0.00;
    public bool $discount = false;
    public ?float $discount_price = 0.00;
    public string $description = '';
    public string $release_date = '';
    public string $developer = '';
    public string $requirements = '';
    public $image;
    public array $tags = [];

    public function formStore()
    {
        $this->validate();
        Stripe::setApiKey(config('cashier.secret'));

        $product = Product::create([ // Creo el producto en Stripe
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $price = Price::create([ // Creo el precio en Stripe
            'unit_amount' => $this->discount ? $this->discount_price * 100 : $this->price * 100,
            'currency' => 'eur',
            'product' => $product->id,
        ]);

        $game = Game::create([ // Creo el juego en Stripe
            'stripe_id' => $product->id,
            'stripe_price_id' => $price->id,
            'image' => ($this->image) ? $this->image->store('images/games') : "images/games/default.jpg",
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount ? true : false,
            'discount_price' => $this->discount ? $this->discount_price : null,
            'description' => $this->description,
            'release_date' => $this->release_date,
            'developer' => $this->developer,
            'requirements' => $this->requirements,
        ]);
        $game->tags()->attach($this->tags);
        
    }

    public function resetFields() {
        $this -> reset();
        $this -> resetValidation();
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:50', 'unique:games,name'],
            'price' => ['required', 'decimal:2', 'between:1,100'],
            'discount' => ['required', 'boolean'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'release_date' => ['required', 'date', 'after_or_equal:today'],
            'developer' => ['required', 'string', 'min:1', 'max:15'],
            'requirements' => ['required', 'string', 'min:10', 'max:350'],
            'image' => ['nullable', 'image', 'max:2048'],
            'tags' => ['required', 'array', 'exists:tags,id'],
        ];

        if ($this->discount) {
            $rules['discount_price'] = ['required', 'decimal:2', 'lt:price']; // Con el lt hago que sea menor que el precio original
        }
        return $rules;
    }
}

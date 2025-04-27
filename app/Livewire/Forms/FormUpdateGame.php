<?php

namespace App\Livewire\Forms;

use App\Models\Game;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;

class FormUpdateGame extends Form
{
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
    public ?Game $game = null;

    public function setGame($game)
    {
        $this->game = $game;
        $this->name = $game->name;
        $this->price = $game->price;
        $this->discount = $game->discount;
        $this->discount_price = $game->discount_price;
        $this->description = $game->description;
        $this->release_date = $game->release_date;
        $this->developer = $game->developer;
        $this->requirements = $game->requirements;
        $this->tags = $game->getArrayTags();
    }

    public function formUpdate()
    {
        $this->validate();
        $this->updateStripeGame();
        $oldImage = $this->game->image;
        $this->game->update([
            'image' => ($this->image) ? $this->image->store('images/games') : $oldImage,
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_price' => ($this->discount) ? $this->discount_price : null,
            'description' => $this->description,
            'release_date' => $this->release_date,
            'developer' => $this->developer,
            'requirements' => $this->requirements,
        ]);
        $this->game->tags()->sync($this->tags);

        if ($this->image && $oldImage != "default.jpg") {
            Storage::delete($oldImage);
        }
    }

    private function updateStripeGame()
    {
        Stripe::setApiKey(config('cashier.secret'));

        Price::update($this->game->stripe_price_id, [ // Desactivo el precio antiguo
            'active' => false,
        ]);

        Product::update($this->game->stripe_id, [ // Actualizo el producto
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $newPrice = Price::create([ // Creo un nuevo precio
            'unit_amount' => $this->discount ? $this->discount_price * 100 : $this->price * 100, // Stripe usa centavos
            'currency' => 'eur',
            'product' => $this->game->stripe_id,
        ]);

        $this->game->update([ // Finalmente actualizo el juego con un nuevo stripe_price_id
            'stripe_price_id' => $newPrice->id,
            'price' => $this->discount ? $this->discount_price : $this->price,
        ]);
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'min:5', 'max:50', 'unique:games,name,' . $this->game->id],
            'price' => ['required', 'decimal:2', 'between:1,100'],
            'discount' => ['required', 'boolean'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'release_date' => ['required', 'date'],
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

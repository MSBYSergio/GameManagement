<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowShop extends Component
{
    use WithPagination;
    public function render()
    {
        $games = Game::select('*')->paginate(4);
        return view('livewire.show-shop', compact('games'));
    }

    public function anadirCarrito(int $id)
    {
        $game = Game::findOrFail($id);
        $price = $game->is_discount ? $game->discount_price : $game->price;
        app('cart')->session(Auth::id())->add(['id' => $game->id, 'name' => $game->name, 'price' => $price, 'quantity' => 1, 'attributtes' => array(), 'associatedModel' => $game]);
    }

    
}

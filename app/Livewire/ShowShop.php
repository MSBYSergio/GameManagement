<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateGame;
use App\Models\Game;
use App\Models\Tag;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Stripe\Product;
use Stripe\Stripe;

class ShowShop extends Component
{
    use WithPagination;
    use WithFileUploads;
    public FormUpdateGame $uForm;
    public bool $openModalUpdate = false;
    public string $search = '';

    #[On('insertGame')]
    public function render()
    {
        $games = Game::select('*')->where(function ($q) {
            $q->where('name', 'like', "%{$this->search}%");
        })->paginate(8);
        $tags = Tag::all();
        return view('livewire.show-shop', compact('games', 'tags'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Métodos para insertar un juego

    public function storeGame(int $id)
    {
        $cart = Cart::instance(Auth::id());
        $game = Game::findOrFail($id);

        if ($this->hasGame($game)) {
            return redirect('/shop')->with('ERROR', "You already have this game");
        }

        if ($this -> isGameInCart($game)) {
            return redirect('/shop')->with('ERROR', "The game is already in the cart");
        }
        
        $price = $game->discount ? $game->discount_price : $game->price;
        $cart->add(['id' => $game->id, 'name' => $game->name, 'qty' => 1, 'price' => $price, 'weight' => -1]) 
        -> associate(Game::class);
        $this->dispatch('message', "Game added to the cart");
    }

    public function hasGame(Game $game)
    {
        return User::findOrFail(Auth::id())->games()->where('games.id', $game->id)->exists();
    }

    public function isGameInCart(Game $game)
    {
        $ocurrences = Cart::instance(Auth::id())->search(function ($cartItem) use ($game) {
            return ($cartItem->id === $game->id);
        });
        return $ocurrences->isNotEmpty();
    }

    // Métodos para eliminar un juego

    public function openDelete(int $id)
    {
        $this->dispatch('confirmDelete', $id);
    }

    #[On('delete')]
    public function delete(int $id)
    {
        $game = Game::findOrFail($id);
        $this->deleteStripeGame($game);
        $image = $game->image;
        if (basename($image) != "default.jpg") {
            Storage::delete($image);
        }
        $game->delete();
        $this->dispatch('message', "Game deleted correctly");
    }

    private function deleteStripeGame($game) // Archivo el producto dentro de Stripe
    {

        Stripe::setApiKey(config('cashier.secret'));
        $game = Product::retrieve($game->stripe_id);
        $game->update($game->id, ['active' => false]);
    }

    // Métodos para actualizar

    public function openUpdate(int $id)
    {
        $game = Game::findOrFail($id);
        $this->uForm->setGame($game);
        $this->openModalUpdate = true;
    }

    public function update()
    {
        $this->uForm->formUpdate();
        $this->close();
        $this->dispatch('message', "Game updated correctly");
    }

    public function clearFields()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function close()
    {
        $this->clearFields();
        $this->openModalUpdate = false;
    }
}

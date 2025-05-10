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
        })-> paginate(4);
        $tags = Tag::all();
        return view('livewire.show-shop', compact('games', 'tags'));
    }

    public function updatingSearch() {
        $this -> resetPage();
    }

    // Métodos para insertar un juego

    public function storeGame(int $id)
    {
        $game = Game::findOrFail($id);
        if ($this->hasGame($game)) {
            return redirect('/')->with('ERROR', "No puedes añadir un juego que ya tienes");
        }
        $price = $game->discount ? $game->discount_price : $game->price;
        Cart::instance(Auth::id())->add(['id' => $game->id, 'name' => $game->name, 'qty' => 1, 'price' => $price, 'weight' => -1]);
    }

    private function hasGame($game)
    {
        return User::findOrFail(Auth::id())->games()->where('games.id', $game->id)->exists();
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

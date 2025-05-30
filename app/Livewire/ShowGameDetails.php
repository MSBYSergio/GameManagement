<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowGameDetails extends Component // Componente Livewire para mostrar todo lo importante del juego
{
    public Game $game;

    public function render()
    {
        return view('livewire.show-game-details');
    }

    public function mount(int $id)
    {
        $this->game = Game::with('comments', 'comments.recibeLikes', 'comments.recibeDisLikes')->findOrFail($id);
    }
    
    public function giveLike(int $id)
    {
        $comment = Comment::findOrFail($id);
        // Si  el usuario ha dado like se lo quito
        if ($comment->recibeLikes()->where('user_id', Auth::id())->exists()) {
            $comment->recibeLikes()->detach(Auth::id());
        } else {
            // Si no ha dado like elimino el dislike (si lo tuviera) y le pongo el like
            $comment->recibeDisLikes()->detach(Auth::id());
            $comment->recibeLikes()->attach(Auth::id());
        }
    }

    public function giveDisLike(int $id)
    {
        $comment = Comment::findOrFail($id);
        // Si el usuario ha dado dislike se lo quito
        if ($comment->recibeDisLikes()->where('user_id', Auth::id())->exists()) {
            $comment->recibeDisLikes()->detach(Auth::id());
        } else {
            // Si no ha dado like elimino el like (si lo tuviera) y le pongo el dislike
            $comment->recibeLikes()->detach(Auth::id());
            $comment->recibeDisLikes()->attach(Auth::id());
        }
    }
}

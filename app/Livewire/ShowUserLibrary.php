<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCommentGame;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserLibrary extends Component
{
    public bool $isOpen = false;
    public FormCommentGame $fComment;
    public int $gameId = 0;

    use WithPagination;
    public function render()
    {
        $library = Game::with('tags')->select('games.*')
            ->join('game_user', 'game_user.game_id', '=', 'games.id')
            ->where('game_user.user_id', '=', Auth::id())->paginate(6);
        return view('livewire.show-user-library', compact('library'));
    }

    public function openCommentModal(int $id)
    {
        $this->isOpen = true;
        $this->gameId = $id;
    }

    public function storeComment()
    {
        if ($this->isCommentRepeated()) {
            return redirect('/')->with('ERROR', "You can´t comment again");
        }
        $this->fComment->formStoreComment($this->gameId);
        $this->dispatch('message', "Comentary saved");
        $this->close();
    }

    private function isCommentRepeated()
    {
        return User::findOrFail(Auth::id())->comments()->where('game_id', $this->gameId)->exists();
    }

    public function close()
    {
        $this->reset();
        $this->resetValidation();
        $this->isOpen = false;
    }
}

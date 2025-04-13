<?php

namespace App\Livewire;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserLibrary extends Component
{
    use WithPagination;
    public function render()
    {
        $library = Game::select('games.image', 'games.name', 'games.description')
            ->join('game_user', 'game_user.game_id', '=', 'games.id')
            ->where('game_user.user_id', '=', Auth::id()) -> paginate(6);
        return view('livewire.show-user-library', compact('library'));  
    }
}

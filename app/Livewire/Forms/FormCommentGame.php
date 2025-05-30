<?php

namespace App\Livewire\Forms;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCommentGame extends Form
{
    #[Validate(['required', 'string', 'in:Recommended,Not Recommended'])]
    public string $user_opinion = '';
    #[Validate(['required', 'string', 'min:5', 'max:80'])]
    public string $comentary = '';

    public function formStoreComment(int $id)
    {
        $this->validate();
        Comment::create([
            'user_opinion' => $this->user_opinion,
            'text' => $this->comentary,
            'user_id' => Auth::id(),
            'game_id' => $id,
        ]);
    }
}

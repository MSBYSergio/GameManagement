<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCreateGame;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateGame extends Component
{
    use WithFileUploads;
    public bool $openModalCreate = false;
    public FormCreateGame $cForm;

    public function render()
    {
        $tags = Tag::all();
        return view('livewire.create-game', compact('tags'));
    }

    public function store()
    {
        $this->cForm->formStore();
        $this->close();
        $this->dispatch('insertGame')->to(ShowShop::class);
        $this->dispatch('message', "Game added correctly");
    }
    
    public function close()
    {
        $this->cForm->resetFields();
        $this->openModalCreate = false;
    }
}

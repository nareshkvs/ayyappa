<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Editor extends Component
{
    public $message;

    public function render()
    {
        return view('livewire.editor');
    }
}

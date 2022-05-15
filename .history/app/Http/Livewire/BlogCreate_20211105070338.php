<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BlogCreate extends Component
{
    public function render()
    {
        return view('livewire.blog-create')->extends('layouts.app')
        ->section('content');;
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Blog as BlogPost;
use Livewire\Component;

class Blog extends Component
{
    public $blog;

    public function mount($slug){
        if($slug != "")
            $this->blog = BlogPost::where('slug', $slug)->first();
        else
            $this->blog = BlogPost::latest();
    }

    public function render()
    {
        return view('livewire.blogs.index');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Blog as BlogPost;
use Livewire\Component;

class Blog extends Component
{
    public $blog;

    public function mount($slug){
        $this->blog = BlogPost::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.blogs.blog');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class Blog extends Component
{
    public $blog;

    public function mount($slug){
        $this->blog = Blog::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.blogs.blog');
    }
}

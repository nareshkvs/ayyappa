<?php

namespace App\Http\Livewire;

use App\Models\Blog as BlogPost;
use Livewire\Component;

class Blog extends Component
{
    public $blog;
    public $slug = null;

    public function mount($slug = ''){
        $this->slug = $slug;
        if($this->slug != "")
            $this->blog = BlogPost::where('slug', $this->slug)->first();
        else
            $this->blog = BlogPost::latest();
    }

    public function render()
    {
        if($this->slug != "")
            return view('livewire.blogs.blog');
        else
            return view('livewire.blogs.index');
    }
}

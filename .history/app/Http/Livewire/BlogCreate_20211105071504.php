<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class BlogCreate extends Component
{
    public $saveSuccess = false;
    public $blog;

    protected $rules = [
        'blog.title' => 'required|min:6',
        'blog.content' => 'required',
        'blog.visibility' => 'required'
    ];

    public function mount(){
        $this->blog = new Blog;
    }

    public function render()
    {
        return view('livewire.blogs.blog-create');
    }

    public function savePost(){
        $this->blog->user_id = Auth::user();
        $this->blog->slug = Str::slug($this->post->title);
        $this->blog->save();
        $this->saveSuccess = true;
    }

}

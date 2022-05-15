<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BlogCreate extends Component
{
    public function render()
    {
        return view('livewire.blogs.blog-create');
    }

    public $saveSuccess = false;
    public $post;

    protected $rules = [
        'post.title' => 'required|min:6',
        'post.body' => 'required|min:6',
    ];

    public function mount(){
        $this->post = new Post;
    }

    public function savePost(){
        $this->post->user_id = 1;
        $this->post->slug = Str::slug($this->post->title);
        $this->post->save();
        $this->saveSuccess = true;
    }

}

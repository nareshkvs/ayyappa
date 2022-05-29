<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class LikesComponent extends Component
{
    public Blog $blog;
    public int $count;

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
        $this->count = $blog->likes_count;
    }

    public function render()
    {
        return view('livewire.likes.index');
    }

    public function like(): void
    {
        if ($this->blog->isLiked()) {
            $this->blog->removeLike();

            $this->count--;
        } elseif (auth()->user()) {
            $this->blog->likes()->create([
                'user_id' => auth()->id(),
            ]);

            $this->count++;
        } elseif (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            $this->blog->likes()->create([
                'ip' => $ip,
                'user_agent' => $userAgent,
            ]);

            $this->count++;
        }
    }


}

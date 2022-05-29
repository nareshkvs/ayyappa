<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;
use App\Models\Comment;
use Livewire\Request;

class Comments extends Component
{
    public Comment $comment;
    public $commentbody, $replyCommentBody, $isShowReplySection = false, $replyParentId;

    public function mount(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function render()
    {
        //dd($this->blog->comments);
        //$blog_comments = Comment::find($this->blog->id);
        return view('livewire.comments.index', ['blog' => $this->blog]);
    }

    public function store()
    {
        $this->validate([
                'commentbody' => ['required', 'string'],
            ]
        );

        $comment = new Comment;
        $comment->body = $this->commentbody;
        $comment->user()->associate(auth()->user());
        $blog = Blog::find($this->blog->id);
        $blog->comments()->save($comment);

        $this->resetInputFields();
        //return back();
    }

    private function resetInputFields(){
        $this->reset(['commentbody', 'replyCommentBody']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openReplySection($commentId) {
        $this->isShowReplySection = true;
        $this->replyParentId = $commentId;
    }

    public function storeReply($commentId) {
        $this->validate([
                'replyCommentBody' => ['required', 'string'],
            ]
        );

        $reply = new Comment();
        $reply->body = $this->replyCommentBody;
        $reply->user()->associate(auth()->user());
        $reply->parent_id = $commentId;
        $blog = Blog::find($this->blog->id);

        $blog->comments()->save($reply);

        $this->resetInputFields();
        $this->isShowReplySection = false;
        $this->replyParentId = '';
    }

}

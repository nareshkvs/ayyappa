<div>
    <h4>Display Comments</h4>
    @foreach($blog->comments as $comment)
        <div class="display-comment">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->body }}</p>
            <a href="javasscript:;" id="reply" wire:click="openReplySection({{ $comment->id }})">Reply</a>
            @if($isShowReplySection && $comment->id == $replyParentId)
            <div class="">
                <form method="post" >
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment_body" class="form-control" wire:model="replyCommentBody" />
                    </div>
                    <div class="form-group">
                        <input type="button" class="btn btn-warning" value="Reply" wire:click="storeReply({{ $comment->id }})" />
                    </div>
                </form>
            </div>
            @endif

            {{-- Replies section --}}
            @foreach($comment->replies as $rComment)
                <div class="ml-2 display-comment">
                    <strong>{{ $rComment->user->name }}</strong>
                    <p>{{ $rComment->body }}</p>
                    <a href="javasscript:;" id="reply" wire:click="openReplySection({{ $rComment->id }})">Reply</a>
                    @if($isShowReplySection && $rComment->id == $replyParentId)
                    <div class="">
                        <form method="post" >
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment_body" class="form-control" wire:model="replyCommentBody" />
                            </div>
                            <div class="form-group">
                                <input type="button" class="btn btn-warning" value="Reply" wire:click="storeReply({{ $rComment->id }})" />
                            </div>
                        </form>
                    </div>
                    @endif

                </div>

            @endforeach
        </div>

    @endforeach
    <hr />
    <hr />
    <h4>Add comment</h4>
    <form method="post">
        @csrf
        <div class="form-group">
            <input type="text" name="comment_body" class="form-control" wire:model="commentbody" />
        </div>
        <div class="form-group">
            <input type="button" class="btn btn-warning" value="Add Comment" wire:click="store" />
        </div>
    </form>
</div>

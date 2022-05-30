<div>
    <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden"><h2 id="notes-title" class="text-lg font-medium text-gray-900">Display Comments</h2>

    <div class="p-2 border-indigo-500 border-top-2">
        @foreach($blog->comments as $comment)
            <div class="pt-2 mt-2" id="parent">
                <div class="flex ">
                    <div class="flex-shrink-0">
                      <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                    <div class="flex-none ml-2">
                        <strong>{{ $comment->user->name }}</strong>
                        <p>{{ $comment->body }}</p>
                        <a href="javasscript:;" id="reply" wire:click="openReplySection({{ $comment->id }})" class="text-xs font-semibold no-underline text-neutral-700 hover:underline">Reply</a>
                    </div>
                </div>
                @if($isShowReplySection && $comment->id == $replyParentId)
                    <div class="mt-2">
                        <form method="post" >
                            @csrf
                            <div class="form-group">
                                <textarea name="comment_body" wire:model="replyCommentBody" rows="3" class="block w-full max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  placeholder="Add Comment"></textarea>
                            </div>
                            <div class="pt-5">
                                <div class="flex justify-end">
                                <button type="button" wire:click="clearCommentBox()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                                <button type="button" wire:click="storeReply({{ $comment->id }}, {{ $comment->user_id }})" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Reply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

                {{-- Replies section --}}
                @foreach($comment->replies as $rComment)
                    <div class="pt-2 mt-2 ml-6"  id="child">
                        <div class="flex ">
                            <div class="flex-shrink-0">
                              <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </div>
                            <div class="flex-none ml-2">
                                <strong>{{ $rComment->user->name }}</strong>
                                <p>{{ $rComment->body }}</p>
                                <a href="javasscript:;" wire:click="openReplySection({{ $rComment->id }})" class="text-xs font-semibold no-underline text-neutral-700 hover:underline">Reply</a>
                            </div>
                        </div>
                        @if($isShowReplySection && $rComment->id == $replyParentId)
                        <div class="">
                            <form method="post" >
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment_body" wire:model="replyCommentBody" rows="3" class="block w-full max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Add Comment"></textarea>
                                </div>
                                <div class="pt-5">
                                    <div class="flex justify-end">
                                    <button type="button" wire:click="clearCommentBox()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                                    <button type="button" wire:click="storeReply({{ $comment->id }}, {{ $rComment->user_id }})" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Reply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif

                    </div>

                @endforeach
            </div>
        @endforeach

        <h4 class="pt-4 text-base">Add Comment</h4>
        <form method="post">
            @csrf
            <div class="form-group">
                <textarea name="comment_body" wire:model="commentbody" rows="3" class="block w-full max-w-lg border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            <div class="py-2">
                <div class="flex justify-end">
                <button type="button" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="store">Add Comment</button>
                </div>
            </div>
        </form>
    </div>
</div>

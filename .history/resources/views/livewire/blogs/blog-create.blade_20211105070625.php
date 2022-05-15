<div>
    <div class="container px-4 mx-auto">
        <h1 class="mt-6 text-4xl font-extrabold leading-10 tracking-tight text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">Create Post</h1>
        <p class="mt-2 text-lg text-gray-600">Start crafting your new post below.</p>
        <div class="w-1/2 mt-10 space-y-8 divide-y divide-gray-200">

            @if($saveSuccess)
                <div class="p-4 bg-green-100 rounded-md rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Successfully Saved Post</h3>
                            <div class="mt-2 text-sm text-green-700">
                                <p>Your new post has been saved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="sm:col-span-6">
                <label for="title" class="block text-sm font-medium text-gray-700">
                    Post Title
                </label>
                <div class="mt-1">
                    <input id="title" wire:model="post.title" name="title" class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5">
                </div>
            </div>
            <div class="pt-5 sm:col-span-6">
                <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                <div class="mt-1">
                    <textarea id="body" rows="3" wire:model="post.body" class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-300 border-gray-400 rounded-md shadow-sm appearance-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <p class="mt-2 text-sm text-gray-500">Add the body for your post.</p>
            </div>
            <div wire:click="savePost" class="inline-flex justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md cursor-pointer hover:bg-indigo-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">Submit Post</div>
        </div>
    </div>
</div>

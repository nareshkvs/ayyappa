<div class="container p-5 mx-auto">
    <h1 class="mt-32 text-4xl font-extrabold leading-10 tracking-tight text-center text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
        Welcome to The Blog
    </h1>

    <div class="max-w-xl mx-auto mt-10">
        @foreach(\App\Models\Post::all() as $post)
            <div class="pb-5 mb-5 border-b border-gray-200">
                <a href="/post/{{ $post->slug }}" class="mb-2 text-2xl font-bold">{{ $post->title }}</a>
                <p>{{ Str::limit($post->body, 100) }}</p>
            </div>
        @endforeach
    </div>
</div>

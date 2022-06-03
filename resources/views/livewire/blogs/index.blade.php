<div class="container p-5 mx-auto">
    <h1 class="mt-32 text-4xl font-extrabold leading-10 tracking-tight text-center text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
        Welcome to The Blog
    </h1>

    <div class="max-w-4xl mx-auto mt-10">
        @foreach(\App\Models\Blog::all() as $blog)
            <div class="pb-5 mt-1 border-b border-gray-200">
                <a href="/blog/{{ $blog->slug }}" class="mb-2 text-2xl font-bold">{{ $blog->title }}</a>
                <p>{{ Str::limit($blog->content, 200) }}</p>
            </div>
        @endforeach
    </div>
</div>

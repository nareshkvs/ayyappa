<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Welcome to The Blog
        </h2>
    </x-slot>

    <div class="container p-5 mx-auto">


        <div class="max-w-4xl mx-auto mt-10 flex flex-col">
            @foreach($blogs as $blog)
                <div class="pb-4 mt-1 border-b border-gray-200">
                    <a href="/blog/{{ $blog->id }}/{{ $blog->slug }}" class="mb-2 text-2xl font-bold hover:text-blue-400">{{ $blog->title }}</a>
                    <p>{{ Str::limit($blog->content, 200) }}</p>
                    @if(strlen($blog->content) > 20)
                    <a href="/blog/{{ $blog->id }}/{{ $blog->slug }}" class="float-right p-2 hover:underline mr-4">View More</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

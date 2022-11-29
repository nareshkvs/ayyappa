<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Welcome to The Blog
        </h2>
    </x-slot>

    <div class="container p-5 mx-auto">


        {{-- <div class="flex flex-col max-w-4xl mx-auto mt-10"> --}}
        <div class="grid gap-16 pt-10 mt-6 lg:grid-cols-2 lg:gap-x-5 lg:gap-y-12">
            @foreach ($blogs as $blog)
                <div>
                    <p class="text-sm text-gray-500">
                        <time datetime="2020-03-16">Mar 16, 2020</time>
                    </p>
                    <a href="/blog/{{ $blog->id }}/{{ $blog->slug }}" class="block mt-2">
                        <p class="text-xl font-semibold text-gray-900">{{ $blog->title }}</p>
                        <p class="mt-3 text-base text-gray-500">{{ Str::limit($blog->content, 200) }}</p>
                    </a>
                    <div class="mt-3">
                        <a href="/blog/{{ $blog->id }}/{{ $blog->slug }}"
                            class="text-base font-semibold text-indigo-600 hover:text-indigo-500">Read full story</a>
                    </div>
                </div>

                {{-- <div class="pb-4 mt-1 border-b border-gray-200">
                    <a href="/blog/{{ $blog->id }}/{{ $blog->slug }}" class="mb-2 text-2xl font-bold hover:text-blue-400">{{ $blog->title }}</a>
                    <p>{{ Str::limit($blog->content, 200) }}</p>
                    @if (strlen($blog->content) > 20)
                    <a href="/blog/{{ $blog->id }}/{{ $blog->slug }}" class="float-right p-2 mr-4 hover:underline">View More</a>
                    @endif
                </div> --}}
            @endforeach
        </div>

        <div>
            <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">

                {{ $blogs->links() }}

            </nav>
        </div>

    </div>
</x-app-layout>

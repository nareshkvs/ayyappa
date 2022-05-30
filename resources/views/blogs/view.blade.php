<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $blog->title }}
        </h2>
    </x-slot> --}}

    <div class="relative py-16 overflow-hidden bg-white">
        <div class="relative px-4 sm:px-6 lg:px-8">
          <div class="mx-auto text-lg max-w-prose">
            <h1>
              <span class="block text-base font-semibold tracking-wide text-center text-indigo-600 uppercase">{{ $blog->title }}</span>
              <span class="block mt-2 text-3xl font-extrabold leading-8 tracking-tight text-center text-gray-900 sm:text-4xl">JavaScript for Beginners</span>
            </h1>
{{--             <p class="mt-8 text-xl leading-8 text-gray-500">Chanting will come here</p> --}}
          </div>
          <div class="mx-auto mt-6 prose prose-lg text-gray-500 prose-indigo">
            {{ $blog->content }}
          </div>
        </div>

        <div class="max-w-xl mx-auto mt-10">
            <livewire:likes-component :blog='$blog'>
        </div>
        <div class="max-w-xl mx-auto mt-10 ">
            <livewire:comments :blog='$blog'>
        </div>

      </div>

    {{-- <div class="container p-5 mx-auto">


        <div class="max-w-xl mx-auto mt-10">
            {{ $blog->content }}
        </div>
        <div class="max-w-xl mx-auto mt-10">
            <livewire:likes-component :blog='$blog'>
        </div>
        <div class="max-w-xl mx-auto mt-10">
            <livewire:comments :blog='$blog'>
        </div>
    </div> --}}
</x-app-layout>

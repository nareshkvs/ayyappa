<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $blog->title }}
        </h2>
    </x-slot>

    <div class="container p-5 mx-auto">


        <div class="max-w-xl mx-auto mt-10">
            {{ $blog->content }}
        </div>
        <div class="max-w-xl mx-auto mt-10">
            <livewire:likes-component :blog='$blog'>
        </div>
        <div class="max-w-xl mx-auto mt-10">
            <livewire:comments :blog='$blog'>
        </div>
    </div>
</x-app-layout>

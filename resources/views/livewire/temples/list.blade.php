<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Temples</h1>
        </div>
    </div>

    <div class="container px-4 mx-auto my-12 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
            @if (count($temples) > 0)
                @foreach ($temples as $temple)
                    <!-- Column -->
                    <div class="w-1/3 px-1 my-1 md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3"
                        wire:click="viewTempleInfo({{ $temple->id }})">

                        <!-- Article -->
                        <article class="overflow-hidden rounded-lg shadow-lg">

                            <a href="#">
                                @if ($temple->photo != null)
                                    <img alt="Placeholder" class="block w-full h-auto" src="{{ $temple->photo }}">
                                @else
                                    <img alt="Placeholder" class="block w-full h-auto"
                                        src="https://picsum.photos/600/400/?random">
                                @endif
                            </a>

                            <header class="flex items-center justify-between p-2 leading-tight md:p-4">
                                <h1 class="text-lg">
                                    <a class="text-black no-underline hover:underline" href="#">
                                        {{ $temple->name }}
                                    </a>
                                </h1>
                                <p class="text-sm text-grey-darker">
                                    <a class="text-black no-underline hover:underline" href="#">
                                        Info
                                    </a>
                                </p>
                            </header>

                            <div class="flex items-center justify-between p-2 leading-tight md:p-4">
                                {{ $temple->description }}
                            </div>

                            <footer class="flex items-center justify-between p-2 leading-none md:p-4">
                                <a class="flex items-center text-black no-underline hover:underline" href="#">
                                    <img alt="Placeholder" class="block rounded-full"
                                        src="https://picsum.photos/32/32/?random">
                                    <p class="ml-2 text-sm">
                                        {{ $temple->address }} {{ $temple->city }} {{ $temple->state }}
                                    </p>
                                </a>
                                <a class="no-underline text-grey-darker hover:text-red-dark" href="#">
                                    <span class="hidden">Like</span>
                                    <i class="fa fa-heart"></i>
                                </a>
                            </footer>

                        </article>
                        <!-- END Article -->

                    </div>
                    <!-- END Column -->
                @endforeach
            @endif
        </div>


        <div>
            <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">

                {{ $temples->links() }}

            </nav>
        </div>

    </div>

</div>

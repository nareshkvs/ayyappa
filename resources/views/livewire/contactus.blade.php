<div>
    <div class="px-6 py-12 mt-12 text-center"><h1 class="mb-6 text-5xl font-bold font-display">Get in touch</h1><p class="max-w-lg mx-auto"></p></div>
    <div class="text-center">
        @if (session()->has('message'))
            <div class="alert alert-success" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                {{ session('message') }}
            </div>
        @endif
    </div>


    <div class="container px-6 mx-auto mb-12">
        <div class="grid max-w-4xl grid-cols-2 gap-0 mx-auto lg:grid-cols-2">
            <div>
                <a href="tel:01632 960192" class="flex items-center my-2"><svg class="w-4 h-4 mr-2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg> +91 - 9533 601 605 </a><a href="mailto:2321 Wildwood Street, OH, 44503"
                    class="flex items-center my-2"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg> tatvamasi@gmail.com</a>
                {{-- <div class="flex items-center my-2"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg> MON-SAT, 9-5 | SUN, 10-4</div> --}}
                    <a
                    href="https://www.google.com/maps/place/2321 Wildwood Street, OH, 44503" target="_blank"
                    class="flex items-center my-2"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg> Hyderabad, 500045</a>
            </div>
            <div>
                <form method="POST" name="contact">
                    <input type="hidden" name="form-name" value="contact">
                    <div>
                        <label class="block text-base tracking-tight text-gray-600">Name</label>
                        <input name="name"
                            type="text" placeholder="Name" required=""
                            class="w-full p-4 mt-2 text-sm text-gray-700 bg-gray-100 border-none" wire:model='name' />
                        </div>
                    <div class="mt-6">
                        <label class="block text-base tracking-tight text-gray-600">Email address</label>
                        <input name="email" type="email" placeholder="your@email.com" required=""
                            class="w-full p-4 mt-2 text-sm text-gray-700 bg-gray-100 border-none"  wire:model='email'>
                        </div>
                    <div class="mt-6">
                        <label class="block text-base tracking-tight text-gray-600">Message</label>
                        <textarea name="message" placeholder="Your message" required=""
                            class="w-full p-4 mt-2 text-sm text-gray-700 bg-gray-100 border-none" wire:model='message'></textarea>
                    </div>
                    <button
                        class="inline-block px-8 py-4 mt-6 text-sm tracking-widest text-white uppercase bg-yellow-800 font-heading" wire:click='sendMessage()'>Send
                        message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            function show_banner(msg, color='red') {
                document.getElementById("banner_text").innerHTML = msg;
                if(color == 'red') {
                    document.getElementById("close_flash_banner").classList.remove('bg-green-400');
                }
                else if(color == 'green') {
                    document.getElementById("close_flash_banner").classList.remove('bg-red-400');
                }
                else {
                    document.getElementById("close_flash_banner").classList.remove('bg-green-400');
                    document.getElementById("close_flash_banner").classList.remove('bg-red-400');
                }
                document.getElementById("close_flash_banner").classList.add('bg-'+color+'-400');

                document.getElementById("alert-banner").style.display = "block";
                document.getElementById("alert-banner").style.animation = 'slide-in-top 200ms forwards';
                setTimeout(function () { hide_banner() }, 5000);
            }

            function hide_banner() {
                document.getElementById("alert-banner").style.animation = 'slide-out-top 2s forwards';
                //document.getElementById("alert-banner").style.display="none";
            }
        </script>
    </body>
</html>

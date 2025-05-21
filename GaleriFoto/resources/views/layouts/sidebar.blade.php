<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/styles.css', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased f-inter">
    <div class="flex h-screen">
        <div class="w-64 h-full px-2 py-8 bg-white inline-flex flex-col justify-start items-center gap-7 overflow-hidden">
            <div class="self-stretch px-4 inline-flex justify-between items-center">
                <div class="justify-start text-black text-2xl font-bold  ">Galeri Foto</div>
                <div class="w-8 h-8 bg-zinc-300">
                    <img src="{{ asset('build/assets/img/left_panel_close.png') }}" alt="Close button">
                </div>
            </div>
            <div class="self-stretch flex flex-col justify-start items-start gap-4">
                <div class="px-4 inline-flex justify-center items-center gap-2.5">
                    <div class="text-center justify-start text-black/50 text-base font-semibold  ">MENU</div>
                </div>
                <div class="self-stretch flex flex-col justify-start items-start">
                    <div class="self-stretch px-5 py-5 bg-zinc-100 rounded-2xl inline-flex justify-start items-center gap-5">
                        <div data-property-1="active" class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/foto_menu.png') }}" alt="Close button">
                        </div>
                        <div class="text-center justify-start text-black text-xl font-medium  ">Foto</div>
                    </div>
                    <div class="self-stretch px-5 py-5 rounded-2xl inline-flex justify-start items-center gap-5">
                        <div data-property-1="folder_open" class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/album_menu.png') }}" alt="Close button">
                        </div>
                        <div class="text-center justify-start text-black text-xl font-medium  ">Album</div>
                    </div>
                    <div class="self-stretch px-5 py-5 rounded-2xl inline-flex justify-start items-center gap-5">
                        <div data-property-1="archive" class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/arsip_menu.png') }}" alt="Close button">
                        </div>
                        <div class="text-center justify-start text-black text-xl font-medium  ">Arsip</div>
                    </div>
                    <div class="self-stretch px-5 py-5 rounded-2xl inline-flex justify-start items-center gap-5">
                        <div data-property-1="love" class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/favorit_menu.png') }}" alt="Close button">
                        </div>
                        <div class="text-center justify-start text-black text-xl font-medium  ">Favorit</div>
                    </div>
                </div>
            </div>
            <div class="self-stretch flex flex-col justify-start items-start gap-4">
                <div class="px-4 inline-flex justify-center items-center gap-2.5">
                    <div class="flex justify-center items-center gap-2.5">
                        <div class="text-center justify-start text-black/50 text-base font-semibold  ">ANDA</div>
                    </div>
                </div>
                <div class="self-stretch flex flex-col justify-start items-start">
                    <div class="self-stretch px-5 py-5 rounded-2xl inline-flex justify-start items-center gap-5">
                        <div data-property-1="account_box" class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/akun_menu.png') }}" alt="Close button">
                        </div>
                        <div class="text-center justify-start text-black text-xl font-medium  ">Akun</div>
                    </div>
                    <div class="self-stretch px-5 py-5 rounded-2xl inline-flex justify-start items-center gap-5">
                        <div data-property-1="exit_to_app" class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/keluar_menu.png') }}" alt="Close button">
                        </div>
                        <div class="text-center justify-start text-black text-xl font-medium  ">Keluar</div>
                    </div>
                </div>
            </div>
        </div>

        <main class="flex-1 p-8 bg-gray-100">
            <h1 class="text-2xl font-bold">Field untuk main</h1>
            @yield('content')
        </main>
    </div>

</body>

</html>
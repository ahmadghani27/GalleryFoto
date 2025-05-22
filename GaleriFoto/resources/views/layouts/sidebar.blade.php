<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts and Styles -->
    @vite(['resources/css/styles.css', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased f-inter">
    <div class="relative min-h-screen flex">
        <!-- Sidebar -->
        <div class="fixed top-0 left-0 w-64 h-screen px-2 py-8 bg-white flex flex-col justify-start items-center gap-7 z-50 transition-transform duration-300 transform md:translate-x-0" id="sidebar">
            <div class="self-stretch px-4 flex justify-between items-center">
                <div class="text-black text-2xl font-bold">Galeri Foto</div>
                <button class="w-8 h-8 bg-zinc-300 lg:hidden" onclick="toggleSidebar()">
                    <img src="{{ asset('build/assets/img/left_panel_close.png') }}" alt="Close button">
                </button>
            </div>
            <div class="self-stretch flex flex-col justify-start items-start gap-4">
                <div class="px-4 flex justify-center items-center gap-2.5">
                    <div class="text-center text-black/50 text-base font-semibold">MENU</div>
                </div>
                <div class="self-stretch flex flex-col justify-start items-start">
                    <a href="" class="self-stretch px-5 py-5 {{ request()->routeIs('photos.index') ? 'bg-zinc-100' : '' }} rounded-2xl flex justify-start items-center gap-5">
                        <div class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/foto_menu.png') }}" alt="Foto menu">
                        </div>
                        <div class="text-center text-black text-xl font-medium">Foto</div>
                    </a>
                    <a href="" class="self-stretch px-5 py-5 {{ request()->routeIs('albums.index') ? 'bg-zinc-100' : '' }} rounded-2xl flex justify-start items-center gap-5">
                        <div class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/album_menu.png') }}" alt="Album menu">
                        </div>
                        <div class="text-center text-black text-xl font-medium">Album</div>
                    </a>
                    <a href="" class="self-stretch px-5 py-5 {{ request()->routeIs('archives.index') ? 'bg-zinc-100' : '' }} rounded-2xl flex justify-start items-center gap-5">
                        <div class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/arsip_menu.png') }}" alt="Arsip menu">
                        </div>
                        <div class="text-center text-black text-xl font-medium">Arsip</div>
                    </a>
                    <a href="" class="self-stretch px-5 py-5 {{ request()->routeIs('favorites.index') ? 'bg-zinc-100' : '' }} rounded-2xl flex justify-start items-center gap-5">
                        <div class="w-10 h-10 relative">
                            <img src="{{ asset('build/assets/img/favorit_menu.png') }}" alt="Favorit menu">
                        </div>
                        <div class="text-center text-black text-xl font-medium">Favorit</div>
                    </a>
                </div>
            </div>
            <div class="self-stretch flex flex-col justify-start items-start gap-4">
                <div class="px-4 flex justify-center items-center gap-2.5">
                    <div class="text-center text-black/50 text-base font-semibold">ANDA</div>
                </div>
                <div class="self-stretch flex flex-col justify-start items-start">
                    @auth
                        <a href="" class="self-stretch px-5 py-5 {{ request()->routeIs('account') ? 'bg-zinc-100' : '' }} rounded-2xl flex justify-start items-center gap-5">
                            <div class="w-10 h-10 relative">
                                <img src="{{ asset('build/assets/img/akun_menu.png') }}" alt="Akun menu">
                            </div>
                            <div class="text-center text-black text-xl font-medium">Akun</div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="self-stretch px-5 py-5 rounded-2xl flex justify-start items-center gap-5">
                            @csrf
                            <button type="submit" class="flex items-center gap-5">
                                <div class="w-10 h-10 relative">
                                    <img src="{{ asset('build/assets/img/keluar_menu.png') }}" alt="Keluar menu">
                                </div>
                                <div class="text-center text-black text-xl font-medium">Keluar</div>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="self-stretch px-5 py-5 {{ request()->routeIs('login') ? 'bg-zinc-100' : '' }} rounded-2xl flex justify-start items-center gap-5">
                            <div class="w-10 h-10 relative">
                                <img src="{{ asset('build/assets/img/akun_menu.png') }}" alt="Login menu">
                            </div>
                            <div class="text-center text-black text-xl font-medium">Login</div>
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 md:ml-64">
            @yield('content')
        </main>
    </div>
</body>
</html>
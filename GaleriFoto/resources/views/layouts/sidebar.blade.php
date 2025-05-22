<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Pixelora')</title>

    <!-- Scripts and Styles -->
    @vite(['resources/css/styles.css', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased f-inter">
    <div class="flex h-dvh">
        <div x-data="{open: true}" x-init="open = window.innerWidth >= 768" @resize.window="open = window.innerWidth >= 900" class="flex h-full w-full">
            <aside :class="open ? 'w-64' : 'w-16'" class="bg-white text-black transition-all duration-300 ease-in-out flex flex-col border-r-1 border-gray-300">
                <div class="flex items-center justify-between p-4">
                    <span class="text-lg font-semibold text-[20px]" x-show="open">GaleriFoto</span>
                    <button @click="open = !open" class="flex  transition-all ease-in-out rounded">
                        <span class="material-symbols-outlined text-[32px]">left_panel_close</span>
                    </button>
                </div>
                <nav class="p-2 flex">
                    <div class="flex-col w-full">
                        <div class="text-[14px] text-slate-400 mb-2 px-2 font-semibold" x-show="open">MENU</div>
                        <div class="w-full h-[1.5px] bg-slate-200 mb-2" x-show="!open"></div>
                        <a href="#" class="flex items-center gap-4 px-2 py-4 w-full rounded-md bg-white hover:bg-slate-100">
                            <span class="material-symbols-outlined text-[32px]">image</span>
                            <span class="text-[20px] font-medium">Foto</span>
                        </a>
                        <a href="#" class="flex items-center gap-4 px-2 py-4 w-full rounded-md bg-white hover:bg-slate-100">
                            <span class="material-symbols-outlined text-[32px]">folder_open</span>
                            <span class="text-[20px] font-medium">Album</span>
                        </a>
                        <a href="#" class="flex items-center gap-4 px-2 py-4 w-full rounded-md bg-white hover:bg-slate-100">
                            <span class="material-symbols-outlined text-[32px]">archive</span>
                            <span class="text-[20px] font-medium">Arsip</span>
                        </a>
                        <a href="#" class="flex items-center gap-4 px-2 py-4 w-full rounded-md bg-white hover:bg-slate-100">
                            <span class="material-symbols-outlined text-[32px]">favorite</span>
                            <span class="text-[20px] font-medium">Favorit</span>
                        </a>
                        <div class="text-[14px] text-slate-400 mb-2 mt-4 px-2 font-semibold" x-show="open">ANDA</div>
                        <div class="w-full h-[1.5px] bg-slate-200 mb-2" x-show="!open"></div>
                        <a href="#" class="flex items-center gap-4 px-2 py-4 w-full rounded-md bg-white hover:bg-slate-100">
                            <span class="material-symbols-outlined text-[32px]">account_box</span>
                            <span class="text-[20px] font-medium">Akun</span>
                        </a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-4 px-2 py-4 w-full rounded-md bg-white hover:bg-slate-100">
                                <span class="material-symbols-outlined text-[32px]">exit_to_app</span>
                                <span class="text-[20px] font-medium">Keluar</span>
                            </a>
                        </form>
                    </div>
                </nav>
            </aside>

            <main class="flex-1 bg-gray-100">
                @yield('content')
            </main>
        </div>

    </div>

</body>

</html>
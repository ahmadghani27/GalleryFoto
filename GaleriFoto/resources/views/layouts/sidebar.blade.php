<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Pixelora')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon">

    @vite(['resources/css/styles.css', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-inter">
    <div class="flex h-dvh w-full">
        <div
            x-data="{ open: true }"
            x-init="open = window.innerWidth >= 768"
            @resize.window="open = window.innerWidth >= 900"
            class="flex h-full transition-all duration-300"
            :class="open ? 'w-56' : 'w-16'">

            <aside
                :class="open ? 'w-56' : 'w-16'"
                class="bg-white text-black fixed top-0 transition-all ease-in-out flex flex-col border-r-[1.5px] border-gray-200 h-dvh">
                <div class="flex items-center justify-between p-4">
                    <span class="text-3xl font-bold"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-x-10"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-x-0"
                        x-transition:leave-end="opacity-0 -translate-x-10"
                        x-show="open"><img src="{{ asset('assets/img/Pixelora.png') }}" class="h-8 w-auto" alt="Pixelora">
                    </span>
                    <button @click="open = !open" class="flex items-center transition-all ease-in-out rounded">
                        <span class="material-symbols-outlined text-[32px]">left_panel_close</span>
                    </button>
                </div>
                <nav class="p-2 flex">
                    <div class="flex-col w-full">
                        <div class="text-[14px] text-slate-400 mb-2 px-2 font-semibold" x-show="open">MENU</div>
                        <div class="w-full h-[1.5px] bg-slate-200 mb-2" x-show="!open"></div>
                        <a href="{{ route('foto') }}" class="flex items-center gap-4 px-2 py-4 w-full rounded-2xl bg-white hover:bg-slate-100 {{ Route::is('foto*') ? '!bg-slate-100 icon-filled' : '' }}">
                            <span class="material-symbols-outlined text-[32px]">image</span>
                            <span class="text-[20px] font-normal" x-show="open">Foto</span>
                        </a>
                        <a href="{{ route('album') }}" class="flex items-center gap-4 px-2 py-4 w-full rounded-2xl bg-white hover:bg-slate-100 {{ Route::is('album*') ? 'bg-cyan-600' : '' }}">
                            <span class="material-symbols-outlined text-[32px] {{ Route::is('album*') ? 'text-white' : '' }}" >folder_open</span>
                            <span class="text-[20px] font-normal {{ Route::is('album*') ? 'text-white' : '' }}" x-show="open">Album</span>
                        </a>
                        <a href="{{ route('arsip') }}" class="flex items-center gap-4 px-2 py-4 w-full rounded-2xl bg-white hover:bg-slate-100 {{ Route::is('arsip*') ? '!bg-slate-100 icon-filled' : '' }}">
                            <span class="material-symbols-outlined text-[32px]">archive</span>
                            <span class="text-[20px] font-normal" x-show="open">Arsip</span>
                        </a>
                        <a href="{{ route('favorit') }}" class="flex items-center gap-4 px-2 py-4 w-full rounded-2xl bg-white hover:bg-slate-100 {{ Route::is('favorit*') ? '!bg-slate-100 icon-filled' : '' }}">
                            <span class="material-symbols-outlined text-[32px]">favorite</span>
                            <span class="text-[20px] font-normal" x-show="open">Favorit</span>
                        </a>
                        <div class="text-[14px] text-slate-400 mb-2 mt-4 px-2 font-semibold" x-show="open">ANDA</div>
                        <div class="w-full h-[1.5px] bg-slate-200 mb-2" x-show="!open"></div>
                        <a href="{{ route('akun') }}" class="flex items-center gap-4 px-2 py-4 w-full rounded-2xl bg-white hover:bg-slate-100 transition-all ease-in-out {{ Route::is('akun') ? '!bg-slate-100 icon-filled' : '' }}">
                            <span class="material-symbols-outlined text-[32px]">account_box</span>
                            <span class="text-[20px] font-normal" x-show="open">Akun</span>
                        </a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-4 px-2 py-4 w-full rounded-2xl bg-white hover:bg-slate-100">
                                <span class="material-symbols-outlined text-[32px]">exit_to_app</span>
                                <span class="text-[20px] font-normal" x-show="open">Keluar</span>
                            </a>
                        </form>
                    </div>
                </nav>
            </aside>

        </div>

        <main class="flex-1 w-full h-full bg-gray-100 transition-all duration-300 ease-in-out">
            @yield('content')
        </main>
    </div>

</body>

</html>
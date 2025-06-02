@extends('layouts.sidebar')
@section('title', 'Album')
@section('content')
<div class="flex flex-col  bg-gray-100">
    @if (session('status'))
    <div class="toast toast-center" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
        <div class="flex items-center alert bg-green-300 border-none">
            <span>{{ session('status') }}</span>
            <button type="button" class="flex text-sm hover:text-black text-gray-800" @click="show = false">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    </div>
    @endif
    <div class="sticky top-0 z-40 px-6 pt-3 pb-3 bg-white border-b-[1.5px] border-gray-200">
        <article class="w-full flex justify-between items-center">
            <div class="text-black text-2xl font-bold p-2">Album</div>
        </article>
        <div class="w-full h-16 flex justify-start items-center gap-4" x-data="{
        isSearchFocused: false,
        isMobile: window.innerWidth < 768,
        init() {
            const updateWidth = () => this.isMobile = window.innerWidth < 768;
            window.addEventListener('resize', updateWidth);
        }
    }"
            x-init="init()">
            <div
                class="flex-1 py-1 pl-5 pr-3 bg-white rounded-full border-[1.5px] border-cyan-600 flex justify-between items-center focus-within:border-cyan-600 focus-within:ring-1 focus-within:ring-cyan-600 focus-within:outline-none">
                <div class="flex justify-start items-center gap-4 w-full h-12">
                    <span class="material-symbols-outlined text-cyan-600">search</span>
                    <input
                        id="searchAlbumField"
                        type="text"
                        value="{{ request('search') }}"
                        x-on:focus="isSearchFocused = true"
                        x-on:blur="isSearchFocused = false"
                        x-on:input="isSearchFocused = true"
                        class="searchFoto text-neutral-900 font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0 text-lg h-full"
                        placeholder="Cari foto anda" />
                    <button
                        id="clearSearchAlbumBtn"
                        type="button"
                        class="clearSearchBtn h-full {{ $search ? '' : 'hidden' }}"
                        aria-label="Clear search">
                        <span class="material-symbols-outlined text-red-600 hover:text-cyan-600 h-full flex items-center px-2">
                            close
                        </span>
                    </button>
                </div>
            </div>

            <!-- Tombol Urutan Terbaru / Terlama -->
            <div
                x-data="{ open: false, selected: new URLSearchParams(window.location.search).get('sort') === 'asc' ? 'Terlama' : 'Terbaru' }"
                x-show="!(isSearchFocused && isMobile)"
                x-transition
                class="relative h-14">
                <div
                    @click="open = !open"
                    :class="{ 'rounded-t-2xl': open, 'rounded-full': !open }"
                    class="cursor-pointer px-5 py-3 !bg-cyan-600 rounded-full flex justify-start items-center gap-2 h-full">
                    <span class="material-symbols-outlined cursor-pointer text-white">
                        format_line_spacing
                    </span>
                    <div x-text="selected" class="text-white text-base font-normal font-inter"></div>
                </div>

                <div
                    x-show="open"
                    @click.away="open = false"
                    class="absolute top-full left-0 w-full bg-transparent">
                    <div class="flex flex-col">
                        <template x-if="selected === 'Terbaru'">
                            <a
                                href="{{ route('album', ['sort' => 'asc']) }}"
                                @click="selected = 'Terlama'; open = false"
                                class="text-center px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
                                Terlama
                            </a>
                        </template>
                        <template x-if="selected === 'Terlama'">
                            <a
                                href="{{ route('album', ['sort' => 'desc']) }}"
                                @click="selected = 'Terbaru'; open = false"
                                class="text-center px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
                                Terbaru
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah Album -->
            <button
                x-show="!(isSearchFocused && isMobile)"
                x-transition
                type="button"
                class="cursor-pointer p-3 !bg-cyan-600 rounded-full flex items-center justify-center gap-2 h-14"
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah-album' }))"
                x-init="open = window.innerWidth >= 768"
                @resize.window="open = window.innerWidth >= 900">
                <span class="material-symbols-outlined text-white" :class="open ? '' : 'w-8'">add</span>
                <span class="text-white font-semibold hidden md:inline">Tambah album</span>
            </button>
        </div>
    </div>
    <div class="block p-6">
        @if ($album->isEmpty())
        <div class="w-full h-60 flex flex-col justify-center items-center gap-4 text-black">
            <div class="text-xl font-normal">
                Belum ada album yang Anda buat
            </div>
            <div>
                <button class="px-6 py-3 rounded-2xl border border-black text-base font-bold hover:bg-black hover:text-white transition" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah-album' }))">
                    Buat Album
                </button>
            </div>
        </div>
        @else
        <div class="foto-group grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
            @foreach ($album as $item)
            <x-album-tumbnail :folder="$item" />
            @endforeach
        </div>
        @endif

    </div>
</div>
<x-modal name="tambah-album" :show="$errors->any()" :closeOnOutsideClick="false" maxWidth="lg">
    <form method="POST" action="{{ route('album.store') }}">
        @csrf
        <div class="px-8 py-8 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex flex-col justify-start items-start gap-4 overflow-y-auto">
            <div class="w-full bg-white rounded-2xl inline-flex flex-col justify-start items-start gap-6">
                <div class="self-stretch flex flex-col justify-start items-start gap-3">
                    <div class="self-stretch justify-start text-black text-xl font-semibold">Buat album baru</div>
                    <div class="self-stretch justify-start text-black/70 text-base font-normal">Kelompokan momen terbaik anda</div>
                </div>
                <div class="self-stretch h-14 px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex items-center gap-4">
                    <span class="material-symbols-outlined">folder_open</span>
                    <input type="text" name="title" class="w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0 placeholder:text-black/50" placeholder="Masukkan judul album disini" value="{{ old('title') }}">
                </div>
                @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <div class="self-stretch inline-flex justify-start items-start gap-2">
                    <button type="button" @click="$dispatch('close-modal', 'tambah-album')" class="flex-1 h-14 px-2.5 py-5 rounded-2xl flex justify-center items-center gap-2.5 hover:bg-gray-200 transition-all ease-in-out">
                        <div class="justify-start text-neutral-900 text-base font-bold">Batal</div>
                    </button>
                    <button type="submit" class="flex-1 h-14 px-2.5 py-5 bg-gray-900 rounded-2xl text-white flex justify-center items-center gap-2.5 hover:bg-black transition-all ease-in-out">
                        <div style="color: inherit" class="justify-start text-neutral-900 text-base font-bold">Buat album</div>
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-modal>
@endsection
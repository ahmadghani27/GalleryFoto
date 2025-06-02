@extends('layouts.sidebar')
@section('title', 'Album')
@section('content')
<div class="flex flex-col h-full bg-white">
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
    <div class="sticky top-0 z-40 px-6 pt-6 pb-3 bg-white">
        <nav class="font-bold" aria-label="breadcrumb">
            <ol class="flex gap-4 items-center">
                <li>
                    <a href="{{ route('album') }}" class="hover:text-yellow-600 text-gray-500 text-2xl font-bold p-2">Album</a>
                </li>
            </ol>
        </nav>
        <div class="w-full h-16 flex justify-start items-center gap-4 mt-3" x-data="{
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
                    <div x-text="selected" class="text-white font-normal font-inter"></div>
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
                                class="text-center px-5 py-3 text-neutral-900 font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
                                Terlama
                            </a>
                        </template>
                        <template x-if="selected === 'Terlama'">
                            <a
                                href="{{ route('album', ['sort' => 'desc']) }}"
                                @click="selected = 'Terbaru'; open = false"
                                class="text-center px-5 py-3 text-neutral-900 font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
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
    @if ($album->isEmpty() )
    <div class="w-full h-full rounded-t-3xl bg-stone-50 flex flex-col justify-center items-center gap-4 text-black overflow-y-auto">
        <div class="text-xl font-normal translate-y-[-15dvh]">
            Belum ada album
        </div>
        <div>
            <button onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah-album' }))" class="px-6 py-3 translate-y-[-15dvh] rounded-2xl border border-gray-500 font-bold hover:bg-cyan-600 hover:text-white transition text-black">
                Upload foto
            </button>
        </div>
    </div>
    @else
    <div class="block p-6 w-full h-full rounded-t-3xl bg-stone-50 overflow-y-auto">
        <div class="foto-group grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
            @foreach ($album as $item)
            <x-album-tumbnail :folder="$item" />
            @endforeach
        </div>
    </div>
    @endif
</div>
<x-modal name="tambah-album" :show="$errors->any()" :closeOnOutsideClick="false" maxWidth="lg">
    <form method="POST" action="{{ route('album.store') }}">
        @csrf
        <div class="px-8 py-8 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex flex-col justify-start items-start gap-4 overflow-y-auto">
            <div class="w-full bg-white rounded-2xl inline-flex flex-col justify-start items-start gap-6">
                <div class="self-stretch flex flex-col justify-start items-start gap-3">
                    <div class="self-stretch justify-start text-black text-xl font-semibold">Buat album baru</div>
                    <div class="self-stretch justify-start text-black/70 font-normal">Kelompokan momen terbaik anda</div>
                </div>
                <div class="self-stretch h-14 px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex items-center gap-4">
                    <span class="material-symbols-outlined">folder_open</span>
                    <input type="text" name="title" class="w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0 placeholder:text-black/50" placeholder="Masukkan judul album disini" value="{{ old('title') }}">
                </div>
                @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <div class="self-stretch inline-flex justify-start items-start gap-2">
                    <!-- Tombol Batal -->
                    <button type="button"
                        @click="$dispatch('close-modal', 'tambah-album')"
                        class="flex-1 h-14 px-2.5 py-5 rounded-2xl flex justify-center items-center gap-2.5 hover:bg-red-100 transition-all ease-in-out">
                        <div class="text-neutral-900 font-bold">Batal</div>
                    </button>

                    <!-- Tombol Buat Album -->
                    <button type="submit"
                        class="flex-1 h-14 px-2.5 py-5 rounded-2xl text-white flex justify-center items-center gap-2.5 bg-cyan-600 transition-all ease-in-out"
                        x-data="{ submitting: false }"
                        @click="submitting = true">

                        <!-- Saat belum submitting -->
                        <template x-if="!submitting">
                            <span class="font-bold text-white">Buat album</span>
                        </template>

                        <!-- Saat sedang submitting -->
                        <template x-if="submitting">
                            <div role="status">
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </template>
                    </button>
                </div>

            </div>
        </div>
    </form>
</x-modal>
@endsection
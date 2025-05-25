@extends('layouts.sidebar')
@section('title', 'Album')
@section('content')
<div class="flex flex-col gap-2 px-8  bg-gray-100">
    <div class="sticky top-0 z-40 bg-gray-100 py-2">
        <article class="w-full flex justify-between items-center">
            <div class="text-black text-xl font-bold p-4">Album</div>
        </article>
        <div class="w-full h-16 flex justify-start items-center gap-4">
            <div class="cursor-pointer p-4 bg-neutral-900 rounded-full flex justify-center items-center gap-2.5 bg-black"
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))">
                <span class="material-symbols-outlined text-white">add</span>
            </div>
            <div class="w-auto h-16 px-5 bg-white rounded-[999px] outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-between items-center">
                <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input
                        type="text"
                        value="Monyet"
                        class="text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0"
                        placeholder="Cari foto..." />
                </div>
                <span class="material-symbols-outlined">
                    close
                </span>
            </div>
            <div x-data="{ open: false, selected: 'Terbaru' }" class="relative">
                <div
                    @click="open = !open"
                    :class="open ? 'rounded-t-2xl' : 'rounded-2xl'"
                    class="cursor-pointer h-14 px-5 py-5 bg-white  outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-start items-center gap-2">
                    <span class="material-symbols-outlined cursor-pointer">
                        format_line_spacing
                    </span>
                    <div x-text="selected" class="text-neutral-900 text-base font-normal font-inter group-hover:text-white"></div>
                </div>

                <div
                    x-show="open"
                    @click.away="open = false"
                    class=" top-full left-0 w-full bg-white rounded-b-2xl outline outline-1 outline-offset-[-1px] outline-black/10 z-10">
                    <div class="flex flex-col">
                        <template x-if="selected === 'Terbaru'">
                            <button
                                @click="selected = 'Terlama'; open = false"
                                class="px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 rounded-b-2xl">
                                Terlama
                            </button>
                        </template>
                        <template x-if="selected === 'Terlama'">
                            <button
                                @click="selected = 'Terbaru'; open = false"
                                class="px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 rounded-b-2xl">
                                Terbaru
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-6 max-w-full">
        <div class="relative aspect-square bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow  min-w-[300px] max-w-[450px]">
            <!-- Gambar -->
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="absolute inset-0 w-full h-full object-cover ">

            <!-- Keterangan -->
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-white">
                <div class="flex justify-between items-center">
                    <div class="space-y-1">
                        <h3 class="text-lg font-semibold text-gray-900">Kenangan</h3>
                        <p class="text-sm text-gray-600">Dibuat 25 Mei 2025</p>
                    </div>

                    <!-- Dropdown Trigger -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="px-1 py-2 rounded-full hover:bg-gray-100 flex justify-center items-center">
                            <span class="material-symbols-outlined cursor-pointer text-gray-600">
                                more_vert
                            </span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            class="absolute right-[-30%] bottom-[85%] mb-2 z-10"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <div class="w-[160px] bg-zinc-100 rounded-xl outline outline-1 outline-offset-[-1px] outline-black/10 inline-flex flex-col justify-start items-start gap-0.5 shadow-lg">
                                <div class="self-stretch p-3 inline-flex justify-start items-center gap-2.5 hover:bg-zinc-200 rounded-lg cursor-pointer">
                                    <span class="material-symbols-outlined cursor-pointer text-gray-600">
                                        edit
                                    </span>
                                    <div class="text-neutral-900 text-base font-normal">Ganti nama</div>
                                </div>
                                <div class="self-stretch p-3 inline-flex justify-start items-center gap-2.5 hover:bg-zinc-200 rounded-lg cursor-pointer">
                                    <span class="material-symbols-outlined cursor-pointer text-gray-600">
                                        delete
                                    </span>
                                    <div class="text-neutral-900 text-base font-normal">Hapus album</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Alpine JS -->
    <!-- <div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-6 max-w-full">
        <div class="relative aspect-square bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"> -->
    <!-- Gambar dengan overlay untuk keterangan -->
    <!-- <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="absolute inset-0 w-full h-full object-cover"> -->

    <!-- Keterangan yang menimpa bagian bawah -->
    <!-- <div class="absolute bottom-0 left-0 right-0 p-4 bg-white">
                <div class="flex justify-between items-center text-white">
                    <div class="space-y-1">
                        <h3 class="text-lg font-semibold">Kenangan</h3>
                        <p class="text-sm opacity-90">Dibuat 25 Mei 2025</p>
                    </div>
                    <div class="flex items-center space-x-2"></div>>
                        <span class="material-symbols-outlined cursor-pointer">
                            more_vert
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

@endsection
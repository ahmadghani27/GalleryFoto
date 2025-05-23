@extends('layouts.sidebar')
@section('content')

<div class="flex flex-col bg-white">
    <div class="sticky top-0 z-40 px-6 py-3 pt-6 bg-white border-b-[1.5px] border-gray-200">
        <div class="flex gap-5">
            <div class="flex-1 py-1 px-5 bg-white rounded-full border-[1.5px] border-gray-300 flex justify-between items-center">
                <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input
                        type="search"
                        value="Monyet"
                        class="text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0"
                        placeholder="Cari foto..." />
                </div>
            </div>
            <button type="button" class="cursor-pointer p-3 !bg-black rounded-full flex items-center gap-2 pr-4">
                <span class="material-symbols-outlined text-gray-300">
                    add
                </span>
                <span class="text-gray-300 font-semibold">Tambah Foto</span>
            </button>
        </div>
        <div class="w-full flex items-center mt-3 gap-6">
            <div class="flex justify-end items-center gap-5">
                <div x-data="{ open: false, selected: 'Terbaru' }" class="relative">
                    <div
                        @click="open = !open" :class ="{'rounded-t-md': open, 'rounded-full': !open}"
                        class="cursor-pointer px-5 py-3 !bg-white border-[1.5px] border-gray-300 rounded-full flex justify-start items-center gap-2
                        ">
                        <span class="material-symbols-outlined cursor-pointer">
                            format_line_spacing
                        </span>
                        <div x-text="selected" class="text-neutral-900 text-base font-normal font-inter group-hover:text-white"></div>
                    </div>

                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute top-full left-0 w-full bg-transparent">
                        <div class="flex flex-col">
                            <template x-if="selected === 'Terbaru'">
                                <button
                                    @click="selected = 'Terlama'; open = false"
                                    class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300">
                                    Terlama
                                </button>
                            </template>
                            <template x-if="selected === 'Terlama'">
                                <button
                                    @click="selected = 'Terbaru'; open = false"
                                    class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300"">
                                    Terbaru
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-gray-500 text-md font-normal font-inter bg-white/80 backdrop-blur-lg">Menampilkan 1 Foto</div>
        </div>
    </div>
    <div class="block p-6">
        <div class="grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
            @for ($i = 0; $i < 7; $i++)
                <x-photo-tumbnail></x-photo-tumbnail>
            @endfor 
        </div>
    </div>
</div>
@endsection
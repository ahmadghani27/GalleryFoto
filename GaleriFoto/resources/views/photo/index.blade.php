@extends('layouts.sidebar')
@section('content')

<div class="flex flex-col gap-4 px-8  bg-gray-100">
    <div class="sticky top-0 z-40 bg-gray-100 px-[5%] py-4">
        <div class="w-full h-16 px-5 bg-white rounded-[999px] outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-between items-center">
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

        <article class="w-full flex justify-between items-center mt-3">
            <div class="text-black text-xl font-normal font-inter">Menampilkan 1 Foto</div>
            <div class="flex justify-end items-center gap-5">
                <div x-data="{ open: false, selected: 'Terbaru' }" class="relative">
                    <div
                        @click="open = !open"
                        class="cursor-pointer h-14 px-5 py-5 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-start items-center gap-2">
                        <span class="material-symbols-outlined cursor-pointer">
                            format_line_spacing
                        </span>
                        <div x-text="selected" class="text-neutral-900 text-base font-normal font-inter group-hover:text-white"></div>
                    </div>

                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute top-full left-0 w-full bg-white rounded-b-2xl outline outline-1 outline-offset-[-1px] outline-black/10 z-10">
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

                <div class="cursor-pointer p-4 bg-neutral-900 rounded-[999px] flex justify-start items-center gap-2.5">
                    <span class="material-symbols-outlined text-white">
                        add
                    </span>
                </div>
            </div>
        </article>
    </header>

    <div>
        <div class="self-stretch justify-start text-black text-xl font-medium f-inter">“Monyet”</div>
    </div>
    <div class="grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-sm overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
    </section>
</div>
@endsection
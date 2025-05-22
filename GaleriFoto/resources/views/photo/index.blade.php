@extends('layouts.sidebar')
@section('content')

<div class="flex flex-col gap-4 px-8">
    <header class="sticky top-0 z-40 bg-gray-100 px-[5%] py-4">
        <div class="w-full h-16 px-5 bg-white rounded-[999px] outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-between items-center">
            <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                <div class="w-6 h-6 bg-zinc-300"></div>
                <input
                    type="text"
                    value="Monyet"
                    class="text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0"
                    placeholder="Cari foto..." />
            </div>
            <div class="w-3.5 h-3.5 bg-zinc-900"></div>
        </div>

        <article class="w-full flex justify-between items-center mt-3">
            <div class="text-black text-xl font-normal font-inter">Menampilkan 1 Foto</div>
            <div class="flex justify-end items-center gap-5">
                <div class="h-14 px-5 py-5 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-start items-center gap-2">
                    <div class="w-5 h-4 bg-neutral-900"></div>
                    <div class="text-neutral-900 text-base font-normal font-inter">Sort (Terbaru)</div>
                </div>
                <div class="p-4 bg-neutral-900 rounded-[999px] flex justify-start items-center gap-2.5">
                    <div class="w-3.5 h-3.5 bg-white"></div>
                </div>
            </div>
        </article>
    </header>

    <div>
        <div class="self-stretch justify-start text-black text-xl font-medium f-inter">“Monyet”</div>
    </div>
    <section class="grid grid-cols-[repeat(auto-fill,minmax(240px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
        <div class="aspect-square rounded-md overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-md overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-md overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-md overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-md overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
        <div class="aspect-square rounded-md overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[240px] max-w-[400px]">
        </div>
    </section>
</div>
@endsection
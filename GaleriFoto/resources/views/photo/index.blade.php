@extends('layouts.sidebar')
@section('content')

<div class="flex flex-col gap-3">
    <div class="flex flex-col gap-3 items-center px-[5%]">
        <div class="w-full h-16 px-5 bg-white rounded-[999px] outline outline-1 outline-offset-[-1px] outline-black/10 inline-flex justify-between items-center">
            <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                <div class="w-6 h-6 bg-zinc-300"></div>
                <input
                    type="text"
                    value="Monyet"
                    class="text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0" />
            </div>
            <div class="w-3.5 h-3.5 bg-zinc-900"></div>
        </div>
        <div class="w-full inline-flex justify-between items-center">
            <div class="justify-start text-black text-xl font-normal f-inter">Menampilkan 1 Foto</div>
            <div class="flex justify-end items-center gap-5">
                <div class="h-14 px-5 py-5 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-start items-center gap-2">
                    <div class="w-5 h-4 bg-neutral-900"></div>
                    <div class="justify-start text-neutral-900 text-base font-normal f-inter">Sort (Terbaru)</div>
                </div>
                <div class="p-4 bg-neutral-900 rounded-[999px] flex justify-start items-center gap-2.5">
                    <div class="w-3.5 h-3.5 bg-white"></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="self-stretch justify-start text-black text-xl font-medium f-inter">“Monyet”</div>
    </div>
</div>
@endsection
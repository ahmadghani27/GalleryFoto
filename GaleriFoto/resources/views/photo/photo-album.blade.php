@extends('layouts.sidebar')
@section('title', 'Foto')
@section('content')

<div class="flex flex-col bg-gray-100">
    <div class="sticky top-0 z-40 px-6 pt-3 pb-3 bg-white border-b-[1.5px] border-gray-200">
        <article class="w-full flex justify-between items-center">
            <div class="text-black text-4xl font-bold p-2">Album > {{ $folder->name_folder }}</div>
        </article>
        <div class="w-full h-16 flex justify-start items-center gap-4">
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
            <div x-data="{ open: false, selected: new URLSearchParams(window.location.search).get('sort') === 'asc' ? 'Terlama' : 'Terbaru' }" class="relative">
                <div
                    @click="open = !open" :class="{'rounded-t-md': open, 'rounded-full': !open}"
                    class="cursor-pointer px-5 py-3 !bg-white border-[1.5px] border-gray-300 rounded-full flex justify-start items-center gap-2">
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
                            <a
                                href="{{ route('album.show', ['folder' => $folder->id_folder]) }}?sort=asc"
                                @click="selected = 'Terlama'; open = false"
                                class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300">
                                Terlama
                            </a>
                        </template>
                        <template x-if="selected === 'Terlama'">
                            <a
                                href="{{ route('album.show', ['folder' => $folder->id_folder]) }}?sort=desc"
                                @click="selected = 'Terbaru'; open = false"
                                class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300">
                                Terbaru
                            </a>
                        </template>
                    </div>
                </div>
            </div>
            <button x-data=" { open: window.innerWidth>= 768 }"
                x-init="open = window.innerWidth >= 768"
                @resize.window="open = window.innerWidth >= 768" type=" button" class="cursor-pointer p-3 !bg-black rounded-full flex items-center gap-2 pr-4" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah-album' }))">
                <span class="material-symbols-outlined text-gray-300">
                    add
                </span>

                <span
                    class="text-gray-300 font-semibold"
                    x-show="open"
                    x-transition>
                    Tambah Album
                </span>
            </button>
        </div>
    </div>

    <div class="text-gray-500 text-md font-normal font-inter bg-white/80 backdrop-blur-lg p-2 rounded-lg">
        @if ($photos->count() == 0)
        Album kosong
        @else
        Menampilkan {{ $photos->count() }} Foto
        @endif
    </div>
</div>
<div class="block p-6">
    <div class="grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
        @foreach($photos as $ft)
        <x-photo-tumbnail
            :path="$ft->file_path"
            :title="$ft->photo_title"
            :date="$ft->created_at"
            :photoId="$ft->id_photo"
            :isLoved="$ft->is_favorite">
            <x-daisy-dropdown>
                <button type="button">
                    <span class="material-symbols-outlined">folder_open</span>
                    <span>Pindah ke album</span>
                </button>
                <button type="button" class="editJudul flex gap-3" onclick="document.getElementById('modalEdit').showModal()">
                    <input type="hidden" class="title_foto" value="{{ $ft->photo_title }}">
                    <input type="hidden" class="id_foto" value="{{ Crypt::encryptString($ft->id_photo) }}">
                    <span class="material-symbols-outlined">edit</span>
                    <span>Ganti judul</span>
                </button>
                <button type="button" class="arsipkanFoto flex gap-3" onclick="document.getElementById('modalArsip').showModal()">
                    <input type="hidden" class="jj" value="{{ Crypt::encryptString($ft->id_photo) }}">
                    <span class="material-symbols-outlined">archive</span>
                    <span>Arsipkan</span>
                </button>
                <button type="button" class="deleteFoto flex gap-3" onclick="document.getElementById('modalDelete').showModal()">
                    <input type="hidden" class="jj" value="{{ Crypt::encryptString($ft->id_photo) }}">
                    <span class="material-symbols-outlined">delete</span>
                    <span>Hapus foto</span>
                </button>
            </x-daisy-dropdown>
        </x-photo-tumbnail>
        @endforeach
    </div>
</div>

</div>
@endsection
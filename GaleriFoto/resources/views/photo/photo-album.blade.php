@extends('layouts.sidebar')
@section('title', 'Foto')
@section('content')

<div class="flex flex-col h-full bg-white">
    <div class="sticky min-h-[130px] h-auto top-0 z-40 px-6 pt-6 pb-3 bg-white">
        <nav class="font-bold" aria-label="breadcrumb">
            <ol class="flex gap-4 items-center">
                <li>
                    <a href="{{ route('album') }}" class="hover:text-yellow-600 text-gray-500 text-2xl">Album</a>
                </li>
                <li class="flex items-center gap-4">
                    <span class="material-symbols-outlined opacity-50 text-yellow-600">chevron_right</span>
                    <a href="{{ route('album.show', $folder->id_folder) }}" aria-current="page" class="hover:text-yellow-600 text-gray-500 text-2xl">{{ $folder->name_folder }}</a>
                </li>
            </ol>
        </nav>
        
        <div class="infoFilter w-full flex items-center mt-3 gap-3" x-cloak x-data="{ show: true }"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-4"
            x-show="show">
            <div
                class="flex-1 pl-5 pr-3 bg-white rounded-full border-[1.5px] border-cyan-600 flex justify-between items-center focus-within:border-cyan-600 focus-within:ring-1 focus-within:ring-cyan-600 focus-within:outline-none">
                <div class="flex justify-start items-center gap-4 w-full h-12">
                    <span class="material-symbols-outlined text-cyan-600">search</span>
                    <input
                        id="searchFotoField"
                        type="text"
                        value="{{ request('search') }}"
                        x-on:focus="isSearchFocused = true"
                        x-on:blur="isSearchFocused = false"
                        x-on:input="isSearchFocused = true"
                        class="searchFoto text-neutral-900 font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0 text-lg h-full"
                        placeholder="Cari foto anda" />
                    <button
                        id="clearSearchBtn"
                        type="button"
                        class="clearSearchBtn h-full {{ $search ? '' : 'hidden' }}"
                        aria-label="Clear search">
                        <span class="material-symbols-outlined text-red-600 hover:text-cyan-600 h-full flex items-center px-2">
                            close
                        </span>
                    </button>
                </div>
            </div>
            @if (!empty($search))
            <div class=" font-semibold text-md flex gap-2 px-4 py-3 bg-slate-100 rounded-full">
                <span class="material-symbols-outlined">filter_alt</span>
                <span class="pr-1">{{ $search }}</span>
            </div>
            @endif
            <div
                x-data="{ open: false, selected: new URLSearchParams(window.location.search).get('sort') === 'asc' ? 'Terlama' : 'Terbaru' }"
                x-transition
            class="relative">
                <div
                    @click="open = !open"
                    :class="{ 'rounded-t-2xl': open, 'rounded-full': !open }"
                    class="cursor-pointer px-5 py-3 !bg-cyan-600 rounded-full flex justify-start items-center gap-2">
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
                                href="{{ route('album.show', ['folder' => $folder->id_folder]) }}?sort=asc"
                                @click="selected = 'Terlama'; open = false"
                                class="text-center px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
                                Terlama
                            </a>
                        </template>
                        <template x-if="selected === 'Terlama'">
                            <a
                                href="{{ route('album.show', ['folder' => $folder->id_folder]) }}?sort=desc"
                                @click="selected = 'Terbaru'; open = false"
                                class="text-center px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
                                Terbaru
                            </a>
                        </template>
                    </div>
                </div>
            </div>
            <button type="button" class="cursor-pointer p-3 !bg-cyan-600 rounded-full flex items-center justify-center gap-2"
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah-foto' }))">
                <span class="material-symbols-outlined text-white" :class="open ? '' : 'w-8'">
                    add
                </span>
                <span class="text-white font-semibold hidden md:inline">Tambah Foto</span>
            </button>
        </div>

        <div x-data="{ show : false }" x-show="show" x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-4"
            class="massActionPanel flex justify-between items-center w-full mt-3">
            <div class="flex items-center">
                <button class="cardBlockBtn flex p-2 hover:bg-gray-100 transition-all ease-in-out rounded-xl">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="ml-2"><span class="cardCounter font-semibold"></span> foto diseleksi</div>
            </div>
            <div class="flex items-center gap-3">
                <button class="massPindahAlbumBtn rounded-xl flex gap-2 p-3 px-4 bg-gray-100 hover:bg-gray-200 active:bg-gray-200 transition-all ease-in-out">
                    <span class="material-symbols-outlined">folder_open</span>
                    <span class="md:inline sm:hidden">Pindah album</span>
                </button>
                <x-modal name="mass-pindah-album-modal" :show="$errors->massPindahAlbum->any()" :closeOnOutsideClick="false">
                    <div class="wrapper mass-pindah-album-modal">
                        <form method="post" action="{{ route('foto.multiplepindahalbum') }}" class="p-6"
                            x-data="{ submitting: false }"
                            @submit.prevent="submitting = true; $el.submit()">
                            @csrf
                            @method('patch')

                            <div class="flex-col gap-4">
                                <div class="text-[20px] font-semibold">Pindahkan <span style="font-weight:inherit; font-size:inherit" class="pindahCounter"></span> foto ke album</div>
                                <div class="mt-2 opacity-70">Kelompokan momen-momen berharga anda</div>
                            </div>

                            <div class="mt-6" x-data="{show: false}">
                                <input type="hidden" class="id_foto" name="id_foto">
                                <label for="current_password" class="font-medium after:ml-0.5 after:text-red-500 after:content-['*']">Album aktif</label>
                                <select required id="mass-album-selector" name="folder_id" class="mt-2 select w-full select-md">
                                    <option disabled selected>Pilih album tujuan</option>
                                </select>
                                @error('folder_id')
                                <p class="text-red-600 text-sm mt-1 " x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-between gap-2 mt-4">
                                <button type="button" @click="show = false; window.dispatchEvent(new CustomEvent('mass-pindah-album-modal'))" :disabled="submitting"
                                    class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">Batal</button>
                                <button type="submit" :disabled="submitting"
                                    class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                                    <template x-if="!submitting">
                                        <span class="text-white">Pindahkan</span>
                                    </template>

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
                        </form>
                    </div>
                </x-modal>
                <button class="massArsipkanBtn rounded-xl flex gap-2 p-3 px-4 bg-gray-100 hover:bg-gray-200 active:bg-gray-200 transition-all ease-in-out">
                    <span class="material-symbols-outlined">archive</span>
                    <span class="md:inline sm:hidden">Arsipkan</span>
                </button>
                <x-modal name="mass-arsipkan-modal" :show="$errors->massArsipkan->any()" :closeOnOutsideClick="false">
                    <div class="wrapper mass-arsipkan-modal">
                        <form method="post" action="{{ route('foto.multiplearsip') }}" class="p-6"
                            x-data="{ submitting: false }"
                            @submit.prevent="submitting = true; $el.submit()">
                            @csrf
                            @method('patch')

                            <div class="flex-col gap-4">
                                <div class="text-[20px] font-semibold">Arsipkan <span style="font-weight:inherit; font-size:inherit" class="arsipCounter"></span> foto</div>
                                <div class="mt-2 opacity-70">Sembunyikan foto pribadi anda</div>
                            </div>

                            <div class="mt-6" x-data="{show: false}">
                                <input type="hidden" class="id_foto" name="id_foto">
                                @error('id_foto')
                                <p class="text-red-600 text-sm mt-1 " x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-between gap-2 mt-4">
                                <button type="button" @click="show = false; window.dispatchEvent(new CustomEvent('mass-arsipkan-modal'))" :disabled="submitting"
                                    class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">Batal</button>
                                <button type="submit" :disabled="submitting"
                                    class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                                    <template x-if="!submitting">
                                        <span class="text-white">Arsipkan</span>
                                    </template>

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
                        </form>
                    </div>
                </x-modal>
                <button class="massDeleteBtn rounded-xl flex gap-2 p-3 px-4 bg-gray-100 hover:bg-gray-200 active:bg-gray-200 transition-all ease-in-out">
                    <span class="material-symbols-outlined">delete</span>
                    <span class="md:inline sm:hidden">Hapus foto</span>
                </button>
                <x-modal name="mass-delete-modal" :show="$errors->massDelete->any()" :closeOnOutsideClick="false">
                    <div class="wrapper mass-delete-modal">
                        <form method="post" action="{{ route('foto.multipledelete') }}" class="p-6"
                            x-data="{ submitting: false }"
                            @submit.prevent="submitting = true; $el.submit()">
                            @csrf
                            @method('patch')

                            <div class="flex-col gap-4">
                                <div class="text-[20px] font-semibold">Hapus <span style="font-weight:inherit; font-size:inherit" class="deleteCounter"></span> foto</div>
                                <div class="mt-2 opacity-70">Perhatian! tindakan ini tidak dapat dikembalikan</div>
                            </div>

                            <div class="mt-6" x-data="{show: false}">
                                <input type="hidden" class="id_foto" name="id_foto">
                                @error('id_foto')
                                <p class="text-red-600 text-sm mt-1 " x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-between gap-2 mt-4">
                                <button type="button" @click="show = false; window.dispatchEvent(new CustomEvent('mass-delete-modal'))" :disabled="submitting"
                                    class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">Batal</button>
                                <button type="submit" :disabled="submitting"
                                    class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                                    <template x-if="!submitting">
                                        <span class="text-white">Hapus foto</span>
                                    </template>

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
                        </form>
                    </div>
                </x-modal>
                <button class="selectAllBtn border-[1.5px] transition-all ease-in-out border-sky-500 hover:bg-sky-100 px-4 active:bg-sky-100 focus:bg-sky-100  rounded-xl btn-primary flex gap-2 p-3  ">
                    <span class="material-symbols-outlined text-sky-500">done_all</span>
                    <span class="md:inline sm:hidden text-sky-500">Pilih semua</span>
                </button>
            </div>
        </div>
    </div>

    @if($photos->isEmpty() && !empty($search))
    <div class="w-full h-full rounded-t-3xl bg-stone-50 flex flex-col justify-center items-center gap-4 text-black overflow-y-auto">
        <div class="text-xl font-normal translate-y-[-15dvh]">
            Foto tidak ditemukan
        </div>
        <div>
            <button onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah-foto' }))" class="px-6 py-3 translate-y-[-15dvh] rounded-2xl border border-gray-500 text-base font-bold hover:bg-cyan-600 hover:text-white transition text-black">
                Tambah foto
            </button>
        </div>
    </div>
    @elseif($photos->isEmpty() && empty($search))
    <div class="w-full h-full rounded-t-3xl bg-stone-50 flex flex-col justify-center items-center gap-4 text-black overflow-y-auto">
        <div class="text-xl font-normal translate-y-[-15dvh]">
            Album kosong
        </div>
        <div>
            <button onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'tambah-foto' }))" class="px-6 py-3 translate-y-[-15dvh] rounded-2xl border border-gray-500 text-base font-bold hover:bg-cyan-600 hover:text-white transition text-black">
                Tambah foto
            </button>
        </div>
    </div>
    @else

    <div class="block p-6 w-full h-full rounded-t-3xl bg-stone-50 overflow-y-auto">
        <div class="text-gray-500 text-md mb-3 font-normal bg-white/80 backdrop-blur-lg">Menampilkan <span>{{ $photos->flatten()->count() }}</span> Foto</div>
        <div class="foto-group grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
            @foreach($photos as $ft)
            <x-photo-tumbnail
                :path="$ft->file_path"
                :title="$ft->photo_title"
                :date="$ft->created_at"
                :photoId="$ft->id_photo"
                :isLoved="$ft->is_favorite">
                <x-daisy-dropdown colorClass="default">
                    <div class="flex-col py-1 gap-2">
                        <button type="button" class="pindahAlbum flex gap-3 px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalPindahAlbum').showModal()">
                            <input type="hidden" class="id_foto" value="{{ $ft->id_photo }}">
                            <input type="hidden" class="title_foto" value="{{ $ft->photo_title }}">
                            <input type="hidden" class="album_id" value="{{ $ft->folder }}">
                            <span class="material-symbols-outlined">folder_open</span>
                            <span>Pindah ke album</span>
                        </button>
                        <button type="button" class="editJudul flex gap-3 px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalEdit').showModal()">
                            <input type="hidden" class="title_foto" value="{{ $ft->photo_title }}">
                            <input type="hidden" class="id_foto" value="{{ Crypt::encryptString($ft->id_photo) }}">
                            <span class="material-symbols-outlined">edit</span>
                            <span>Ganti judul</span>
                        </button>
                        <button type="button" class="arsipkanFoto flex gap-3 px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalArsip').showModal()">
                            <input type="hidden" class="title_foto" value="{{ $ft->photo_title }}">
                            <input type="hidden" class="jj" value="{{ Crypt::encryptString($ft->id_photo) }}">
                            <span class="material-symbols-outlined">archive</span>
                            <span>Arsipkan</span>
                        </button>
                        <button type="button" class="deleteFoto flex gap-3 px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalDelete').showModal()">
                            <input type="hidden" class="title_foto" value="{{ $ft->photo_title }}">
                            <input type="hidden" class="jj" value="{{ Crypt::encryptString($ft->id_photo) }}">
                            <span class="material-symbols-outlined">delete</span>
                            <span>Hapus foto</span>
                        </button>
                    </div>
                </x-daisy-dropdown>
            </x-photo-tumbnail>
            @endforeach
        </div>
    </div>
    @endif
</div>

@include('photo.modal-edit-foto')
@include('photo.modal-delete-foto')
@include('photo.modal-arsip-foto')

<dialog id="modalPindahAlbum" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Pindah "<span id="albumTitle" class="text-lg"></span>" ke album</h3>
        <p class="">Kelompokan momen terbaik anda</p>
        <div class="modal-action flex-col">
            <form method="POST" action="{{ route('foto.singlepindahalbum') }}">
                @csrf
                @method('PATCH')
                <input type="hidden" id="albumId" name="id_foto">
                <label class="" for="album-selector">Pilih album</label>
                <select id="album-selector" name="folder_id" class="mt-2 select w-full select-md">
                    <option disabled selected>Pilih album tujuan</option>
                </select>
                <hr class="mt-4">
                <button type="submit" class="mt-4 btn btn-primary w-full">Pindahkan</button>
            </form>
            <form method="dialog">
                <button class="btn w-full">Batal</button>
            </form>
        </div>
    </div>
</dialog>

{{-- single upload toast --}}
@if (session('status'))
<div class="toast toast-center" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <div class="flex items-center alert bg-green-300 border-none">
        <span>{{ session('message') }}</span>
        <button type="button" class="flex text-sm hover:text-black text-gray-800" @click="show = false">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
</div>
@endif


<x-modal name="tambah-foto" :show="$errors->any()" :closeOnOutsideClick="false" maxWidth="2xl">
    <div class="p-6 w-full bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex flex-col justify-start items-start gap-4 overflow-y-auto">

        <!-- Header Section -->
        <div class="self-stretch flex justify-between items-start gap-5">
            <div class="flex-1 flex flex-col justify-start items-start gap-2">
                <h2 class="self-stretch text-black text-xl font-semibold">Tambah Foto ke Album</h2>
                <p class="self-stretch text-black/70 text-base font-normal">Pilih foto untuk ditambahkan ke album "{{ $folder->name_folder }}"</p>
            </div>
            <button type="button" @click="$dispatch('close-modal', 'tambah-foto')" class="p-1.5 bg-zinc-100 rounded-full flex justify-end items-start gap-2.5">
                <span class="material-symbols-outlined text-red-600 hover:text-cyan-600">close</span>
            </button>
        </div>
        <div class="w-full h-[1.5px] bg-cyan-600"></div>
        <!-- Photo Selection Form -->
        <form action="{{ route('album.add-photos', $folder->id_folder) }}" method="POST"
            x-data="{ submitting: false, selectedPhotos: [] }"
            @submit.prevent="submitting = true; $el.submit()" class="w-full rounded-2xl">
            @csrf

            <!-- Photo Grid -->
            <div class="block p-4 bg-stone-50 rounded-2xl">
                @if($allPhotos->isEmpty())
                <div class="w-full py-12 bg-stone-50 flex flex-col justify-center items-center gap-4 text-black">
                    <div class="text-xl font-normal">
                        Tidak ada foto yang tersedia
                    </div>
                    <div>
                        <button onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-foto' }))" class="px-6 py-3 rounded-2xl border border-black hover:border-cyan-600 text-base font-bold hover:bg-cyan-600 hover:text-white transition">
                            Upload foto baru
                        </button>
                    </div>
                </div>
                @else
                <div class="foto-group grid grid-cols-[repeat(auto-fill,minmax(120px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch ">
                    @foreach ($allPhotos as $ft)
                    <div
                        x-data="{ isSelected: false }"
                        @click="
                        isSelected = !isSelected;
                        if(isSelected) {
                            selectedPhotos.push('{{ $ft->id_photo }}');
                        } else {
                            selectedPhotos = selectedPhotos.filter(id => id !== '{{ $ft->id_photo }}');
                        }
                    "
                        :class="isSelected ? 'ring-2 ring-yellow-500' : ''"
                        class="relative cursor-pointer flex flex-col items-center p-1">

                        <x-tambah-foto
                            :path="$ft->file_path"
                            :title="$ft->photo_title"
                            :date="$ft->created_at"
                            :photoId="$ft->id_photo"
                            :isLoved="$ft->is_favorite">

                            <!-- Selection Indicator -->
                            <div
                                x-show="isSelected"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-75"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-75"
                                class="absolute top-2 right-2 z-10 w-6 h-6 bg-yellow-600 rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-sm">check</span>
                            </div>
                        </x-tambah-foto>

                        <!-- Photo Title -->
                        <div class="mt-2 text-sm text-neutral-900 font-normal font-inter text-center truncate w-full max-w-[120px]">
                            {{ $ft->photo_title }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Hidden Input for Selected Photos -->
            <input type="hidden" name="selected_photos" x-model="selectedPhotos.join(',')">

            <!-- Submit Button -->
            <div class="sticky bottom-0 bg-white p-4 border-t">
                <button
                    type="submit"
                    class="w-full h-14 px-4 py-2 bg-yellow-500 text-white rounded-lg flex justify-center items-center gap-2 transition-all"
                    :disabled="selectedPhotos.length === 0"
                    :class="selectedPhotos.length === 0 ? 'opacity-50 cursor-not-allowed' : ''">

                    <template x-if="!submitting" class="text-white">
                        <span class="text-white">
                            Tambahkan <span x-text="selectedPhotos.length" class="text-cyan-600"></span> Foto ke Album
                        </span>
                    </template>

                    <template x-if="submitting">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </template>
                </button>
            </div>
        </form>
    </div>
</x-modal>
<x-modal name="upload-photo" :show="$errors->any()" :closeOnOutsideClick="false" maxWidth="2xl">
    <div class="px-8 py-8 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex flex-col justify-start items-start gap-4 overflow-y-auto">

        <!-- Header Section -->
        <div class="self-stretch flex justify-between items-center gap-5">
            <div class="flex-1 flex flex-col justify-start items-start gap-2">
                <h2 class="self-stretch text-black text-xl font-semibold">Upload Foto</h2>
                <p class="self-stretch text-black/70 text-base font-normal">Simpan momen terbaik anda</p>
            </div>
            <button type="button" @click="$dispatch('close-modal', 'upload-photo')" class="p-1.5 bg-zinc-100 rounded-full flex justify-start items-center gap-2.5">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Tabs Section -->
        <div x-data="{ tab: 'single' }" class="self-stretch flex flex-col gap-6">

            <!-- Tab Switch -->
            <div class="self-stretch flex justify-start items-end flex-wrap content-end">
                <div class="self-stretch flex justify-start items-end gap-7 flex-wrap content-end">
                    <div class="w-28 flex flex-col justify-start items-start gap-2 cursor-pointer" @click="tab = 'single'">
                        <span :class="tab === 'single' ? 'font-semibold' : 'font-normal'" class="self-stretch text-neutral-900 text-base">Single upload</span>
                        <div :class="tab === 'single' ? 'bg-black' : ''" class="self-stretch h-1.5 rounded-tl-[99px] rounded-tr-[99px]"></div>
                    </div>
                    <div class="flex flex-col justify-start items-start gap-2 cursor-pointer" @click="tab = 'multi'">
                        <span :class="tab === 'multi' ? 'font-semibold' : 'font-normal'" class="text-neutral-900 text-base">Multiple upload</span>
                        <div :class="tab === 'multi' ? 'bg-black' : ''" class="self-stretch h-1.5 rounded-tl-[99px] rounded-tr-[99px]"></div>
                    </div>
                </div>
                <div class="w-full h-[1.5px] bg-zinc-300"></div>
            </div>
            <!-- File Upload Section -->
            <div x-show="tab === 'single'">
                @include('photo.upload')
            </div>

            <div x-show="tab === 'multi'">
                @include('photo.mass_upload')
            </div>

        </div>
    </div>
</x-modal>

<meta name="foto-data" content='@json($photos)'>
@include('photo.modal-detail-foto')

@endsection



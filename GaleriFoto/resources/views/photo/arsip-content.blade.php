@extends('layouts.sidebar')
@section('title', 'Arsip Foto')

@section('content')

<div class="flex flex-col bg-white">
    <div class="transition-all ease-in-out min-h-[148px] sticky top-0 z-40 px-6 py-3 pt-6 bg-white border-b-[1.5px] border-gray-200">
        <div class="flex gap-5">
            <div class="flex-1 py-1 px-5 bg-white rounded-full border-[1.5px] border-gray-300 flex justify-between items-center">
                <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                    <span class="material-symbols-outlined">search</span>
                    <form id="searchForm" method="GET" action="{{ route('arsip.content') }}" class="w-full flex items-center gap-2">
                        <input
                            id="searchFotoField"
                            name="search"
                            type="text"
                            value="{{ $search ?? '' }}"
                            class="searchFoto text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0"
                            placeholder="Cari judul foto"
                            x-data
                            @input.debounce.500ms="
                                if($event.target.value.trim() === '') {
                                    window.location.href = '{{ route('arsip.content') }}';
                                } else {
                                    document.getElementById('searchForm').submit();
                                }
                            " />
                        <button
                            id="clearSearchBtn"
                            type="button"
                            class="clearSearchBtn {{ $search ? '' : 'hidden' }}"
                            aria-label="Clear search"
                            @click="
                                document.getElementById('searchFotoField').value = '';
                                window.location.href = '{{ route('arsip.content') }}';
                            ">
                            <span class="material-symbols-outlined text-gray-500 hover:text-gray-800">close</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex justify-end items-center gap-5">
                <div x-data="{ open: false, selected: '{{ $currentSort === 'asc' ? 'Terlama' : 'Terbaru' }}' }" class="relative">
                    <div
                        @click="open = !open" :class="{'rounded-t-md': open, 'rounded-full': !open}"
                        class="cursor-pointer px-5 py-3 !bg-white border-[1.5px] border-gray-300 rounded-full flex justify-start items-center gap-2">
                        <span class="material-symbols-outlined cursor-pointer">format_line_spacing</span>
                        <div x-text="selected" class="text-neutral-900 text-base font-normal font-inter"></div>
                    </div>
                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute top-full left-0 w-full bg-transparent">
                        <div class="flex flex-col">
                            <template x-if="selected === 'Terbaru'">
                                <a
                                    href="{{ route('arsip.content', ['sort' => 'asc', 'search' => $search]) }}"
                                    @click="selected = 'Terlama'; open = false"
                                    class="text-center px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300">
                                    Terlama
                                </a>
                            </template>
                            <template x-if="selected === 'Terlama'">
                                <a
                                    href="{{ route('arsip.content', ['sort' => 'desc', 'search' => $search]) }}"
                                    @click="selected = 'Terbaru'; open = false"
                                    class="text-center px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300">
                                    Terbaru
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="infoFilter w-full flex items-center mt-3 gap-4" x-cloak x-data="{ show: true }"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-4"
            x-show="show">
            @if (!empty($search))
            <div class="font-semibold text-md flex gap-2 px-4 py-2 bg-slate-100 rounded-full">
                <span class="material-symbols-outlined">filter_alt</span>
                <span class="pr-1">{{ $search }}</span>
            </div>
            @endif
            <div class="text-gray-500 text-md font-normal font-inter bg-white/80 backdrop-blur-lg">
                Menampilkan {{ $arsipFoto->flatten()->count() }} Foto
            </div>
        </div>

        <div x-data="{ show: false }" x-show="show" x-cloak
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
                                <label for="mass-album-selector" class="font-medium after:ml-0.5 after:text-red-500 after:content-['*']">Album aktif</label>
                                <select required id="mass-album-selector" name="folder_id" class="mt-2 select w-full select-md">
                                    <option disabled selected>Pilih album tujuan</option>
                                </select>
                                @error('folder_id')
                                <p class="text-red-600 text-sm mt-1" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
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
                                <p class="text-red-600 text-sm mt-1" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
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
                                <p class="text-red-600 text-sm mt-1" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
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
                <button class="selectAllBtn border-[1.5px] transition-all ease-in-out border-sky-500 hover:bg-sky-100 px-4 active:bg-sky-100 focus:bg-sky-100 rounded-xl btn-primary flex gap-2 p-3">
                    <span class="material-symbols-outlined text-sky-500">done_all</span>
                    <span class="md:inline sm:hidden text-sky-500">Pilih semua</span>
                </button>
            </div>
        </div>
    </div>

    <style>
        .foto-group:last-of-type {
            margin-bottom: 1.5rem
        }
    </style>

    <div class="block px-6 py-2 bg-gray-100">
        @if(!isset($arsipFoto) || $arsipFoto->isEmpty())
        <div class="text-center py-10">
            <p class="text-gray-500">Tidak ada foto di arsip</p>
        </div>
        @else
        @foreach($arsipFoto as $tanggal => $groupedPhotos)
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4">{{ $tanggal }}</h3>
            <div class="foto-group grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
                @foreach($groupedPhotos as $photo)
                <x-photo-tumbnail
                    :path="$photo->file_path"
                    :title="$photo->photo_title"
                    :date="$photo->created_at"
                    :photoId="$photo->id_photo"
                    :isLoved="$photo->is_favorite">
                    <x-daisy-dropdown>
                        <button type="button" class="pindahAlbum flex gap-3 px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalPindahAlbum').showModal()">
                            <input type="hidden" class="id_foto" value="{{ $photo->id_photo }}">
                            <input type="hidden" class="title_foto" value="{{ $photo->photo_title }}">
                            <input type="hidden" class="album_id" value="{{ $photo->folder }}">
                            <span class="material-symbols-outlined">folder_open</span>
                            <span>Pindah ke album</span>
                        </button>
                        <button type="button" class="editJudul flex gap-3 px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalEdit').showModal()">
                            <input type="hidden" class="title_foto" value="{{ $photo->photo_title }}">
                            <input type="hidden" class="id_foto" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <span class="material-symbols-outlined">edit</span>
                            <span>Ganti judul</span>
                        </button>
                        <form action="{{ route('photos.unarchive') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="id_foto" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <button type="submit"
                                class="unarsipkanFoto flex gap-3 items-center px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out text-sm"
                                onclick="return confirm('Yakin ingin mengeluarkan foto ini dari arsip?')">
                                <span class="material-symbols-outlined text-yellow-600">unarchive</span>
                                <span>Keluarkan dari Arsip</span>
                            </button>
                        </form>
                        <button type="button" class="deleteFoto flex gap-3 px-3 py-2 w-full hover:bg-gray-200 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalDelete').showModal()">
                            <input type="hidden" class="jj" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <span class="material-symbols-outlined">delete</span>
                            <span>Hapus foto</span>
                        </button>
                    </x-daisy-dropdown>
                </x-photo-tumbnail>
                @endforeach
            </div>
        </div>
        @endforeach
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
            <span>{{ session('status') }}</span>
            <button type="button" class="flex text-sm hover:text-black text-gray-800" @click="show = false">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    </div>
    @endif

    {{-- multiupload toast --}}
    <div
        x-data="{ show: false, message: '' }"
        x-show="false"
        x-transition
        x-init="$watch('show', value => value && setTimeout(() => show = false, 5000))"
        class="toast toast-center"
        style="display: none;"
        id="multiupload-toast">
        <div class="flex items-center alert bg-green-300 border-none">
            <span x-text="message"></span>
            <button type="button" class="flex text-sm hover:text-black text-gray-800" @click="show = false">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    </div>

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

    @endsection
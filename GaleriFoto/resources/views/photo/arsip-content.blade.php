@extends('layouts.sidebar')
@section('title', 'Arsip Foto')

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
    <div class="sticky min-h-[130px] h-auto top-0 z-40 px-6 pt-6 pb-3 bg-white">
        <nav class="font-bold" aria-label="breadcrumb">
            <ol class="flex gap-4 items-center">
                <li>
                    <a href="{{ route('arsip') }}" class="hover:text-yellow-600 text-gray-500 text-2xl font-bold p-2">Arsip <span class="font-bold text-cyan-600 text-xl">{{ $user->username }}</span></a>
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
                        id="searchAlbumField"
                        name="search"
                        type="text"
                        value="{{ $search ?? '' }}"
                        x-on:focus="isSearchFocused = true"
                        x-on:blur="isSearchFocused = false"
                        x-on:input="isSearchFocused = true"
                        class="searchFoto text-neutral-900 font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0 text-lg h-full"
                        placeholder="Cari foto anda" />
                    <button
                        id="clearSearchAlbumBtn"
                        type="button"
                        class="clearSearchBtn {{ $search ? '' : 'hidden' }}"
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
                                href="{{ route('arsip.content', ['sort' => 'asc', 'search' => $search]) }}"
                                @click="selected = 'Terlama'; open = false"
                                class="text-center px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
                                Terlama
                            </a>
                        </template>
                        <template x-if="selected === 'Terlama'">
                            <a
                                href="{{ route('arsip.content', ['sort' => 'desc', 'search' => $search]) }}"
                                @click="selected = 'Terbaru'; open = false"
                                class="text-center px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-cyan-600 hover:text-white transition-colors duration-200 bg-white rounded-b-2xl border-[1.5px] border-gray-300">
                                Terbaru
                            </a>
                        </template>
                    </div>
                </div>
            </div>
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
                <button class="massArsipkanBtn rounded-xl flex gap-2 p-3 px-4 bg-gray-100 hover:bg-gray-200 active:bg-gray-200 transition-all ease-in-out">
                    <span class="material-symbols-outlined">unarchive</span>
                    <span class="md:inline sm:hidden">Un-arsip</span>
                </button>
                <x-modal name="mass-arsipkan-modal" :show="$errors->massArsipkan->any()" :closeOnOutsideClick="false">
                    <div class="wrapper mass-arsipkan-modal">
                        <form method="post" action="{{ route('foto.multipleunarsip') }}" class="p-6"
                            x-data="{ submitting: false }"
                            @submit.prevent="submitting = true; $el.submit()">
                            @csrf
                            @method('patch')

                            <div class="flex-col gap-4">
                                <div class="text-[20px] font-semibold">Un-arsipkan <span style="font-weight:inherit; font-size:inherit" class="arsipCounter"></span> foto</div>
                                <div class="mt-2 opacity-70">Publikan kembali foto anda</div>
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
                                        <span class="text-white">Un-arsip</span>
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

    @if(!$arsipFoto->count() > 0)
    <div class="w-full h-full rounded-t-3xl bg-stone-50 flex flex-col justify-center items-center gap-4 text-black overflow-y-auto">
        <div class="text-xl font-normal translate-y-[-15dvh]">Tidak ada foto di arsip</div>
    </div>
    @else
    <div class="block px-6 pb-6 w-full h-full rounded-t-3xl bg-stone-50 overflow-y-auto">
        <div class="text-gray-500 text-md text-center font-normal w-full my-3  font-interbg-transparent backdrop-blur-lg">Menampilkan <span class="cardShowCounter"> {{ $arsipFoto->count() }}</span> Foto</div>
        <div class="foto-group grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
            @foreach($arsipFoto as $photo)
            <x-photo-tumbnail
                :path="$photo->file_path"
                :title="$photo->photo_title"
                :date="$photo->created_at"
                :photoId="$photo->id_photo"
                :isLoved="$photo->is_favorite">
                <x-daisy-dropdown colorClass="default">
                    <div class="flex-col gap-2">
                        <button type="button" class="pindahAlbum items-center flex gap-3 px-2 py-2 w-full hover:bg-gray-100 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalEdit').showModal()">
                            <input type="hidden" class="title_foto" value="{{ $photo->photo_title }}">
                            <input type="hidden" class="id_foto" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <span class="material-symbols-outlined p-1">edit</span>
                            <span>Ganti judul</span>
                        </button>
                        <button type="submit"
                            class="pindahAlbum items-center flex gap-3 px-2 py-2 w-full hover:bg-gray-100 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalUnarsip').showModal()">
                            <input type="hidden" class="title_foto" value="{{ $photo->photo_title }}">
                            <input type="hidden" class="id_foto" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <span class="material-symbols-outlined p-1">unarchive</span>
                            <span>Un-arsip</span>
                        </button>
                        <button type="button" class="pindahAlbum items-center flex gap-3 px-2 py-2 w-full hover:bg-gray-100 rounded-md transition-all ease-in-out" onclick="document.getElementById('modalDelete').showModal()">
                            <input type="hidden" class="jj" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <span class="material-symbols-outlined p-1">delete</span>
                            <span>Hapus foto</span>
                        </button>
                    </div>
                </x-daisy-dropdown>
            </x-photo-tumbnail>
            @endforeach
        </div>
    </div>
    @endif

    @include('photo.modal-edit-foto')
    @include('photo.modal-delete-foto')

    <dialog id="modalUnarsip" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Un-arsipkan "<span id="unarsipTitle" class="text-lg"></span>"</h3>
            <p class="">Publikan kembali foto anda</p>
            <div class="modal-action flex-col">
                <form action="{{ route('photos.unarchive') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_foto" id="unarsipId">
                    <button type="submit" class="unarsipkan-confirm btn btn-neutral w-full">Un-arsipkan</button>
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

    <meta name="foto-data" content='@json($arsipFoto->flatten())'>
    @include('photo.modal-detail-foto')

    @endsection
@extends('layouts.sidebar')
@section('title', 'Foto')

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
            <button type="button" class="cursor-pointer p-3 !bg-black rounded-full flex items-center gap-2 pr-4"
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))">
                <span class="material-symbols-outlined text-gray-300">
                    add
                </span>
                <span class="text-gray-300 font-semibold">Tambah Foto</span>
            </button>
        </div>
        <div class="w-full flex items-center mt-3 gap-6">
            <div class="flex justify-end items-center gap-5">
                <div x-data="{ open: false, selected: new URLSearchParams(window.location.search).get('sort') === 'asc' ? 'Terlama' : 'Terbaru' }" class="relative">
                    <div
                        @click="open = !open" :class="{'rounded-t-md': open, 'rounded-full': !open}"
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
                                <a
                                    href="{{ route('foto', ['sort' => 'asc']) }}"
                                    @click="selected = 'Terlama'; open = false"
                                    class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300">
                                    Terlama
                                </a>
                            </template>
                            <template x-if="selected === 'Terlama'">
                                <a
                                    href="{{ route('foto', ['sort' => 'desc']) }}"
                                    @click="selected = 'Terbaru'; open = false"
                                    class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] border-gray-300"">
                                    Terbaru
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-gray-500 text-md font-normal font-inter bg-white/80 backdrop-blur-lg">Menampilkan <span>{{ $foto->count() }}</span> Foto</div>
        </div>
    </div>
    <div class="block px-6 bg-gray-100" >
        @foreach ($foto as $tanggal => $groupedPhotos)
            <span class="text-lg font-bold block mt-4 mb-2">{{ $tanggal }}</span>
                <div class="grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
                    @foreach($groupedPhotos as $ft) 
                        <x-photo-tumbnail
                            :path="$ft->file_path"
                            :title="$ft->photo_title"
                            :date="$ft->created_at"
                            :photoId="$ft->id_photo"
                            :isLoved="$ft->is_favorite"
                        >
                            <x-daisy-dropdown >
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
                                <button type="button" class="arsipkanFoto flex gap-3"  onclick="document.getElementById('modalArsip').showModal()">
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
        @endforeach 
    </div>
</div>

<dialog id="modalEdit" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Ganti Judul</h3>
        <p class="py-4">Perhatian! tindakan ini tidak dapat dikembalikan</p>
        <div class="modal-action">
        <form method="POST" action="{{ route('foto.editjudul') }}">
            @csrf
            @method('PATCH')
            <input type="hidden" id="editId" name="id_foto">
            <input type="text" id="editTitle" name="title_foto" disabled>
            <input type="text" name="new_judul">
            <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
        <form method="dialog">
            <button class="btn">Batal</button>
        </form>
        </div>
    </div>
</dialog> 

<dialog id="modalArsip" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Arsipkan</h3>
        <p class="py-4">Perhatian! tindakan ini tidak dapat dikembalikan</p>
        <div class="modal-action">
        <form method="POST" action="{{ route('foto.singlearsip') }}">
            @csrf
            @method('PATCH')
            <input type="hidden" id="arsipId" name="id_foto">
            <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
        <form method="dialog">
            <button class="btn">Batal</button>
        </form>
        </div>
    </div>
</dialog> 

<dialog id="modalDelete" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Hapus foto</h3>
        <p class="py-4">Perhatian! tindakan ini tidak dapat dikembalikan</p>
        <div class="modal-action">
        <form method="POST" action="{{ route('foto.singledelete') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteId" name="id_foto">
            <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
        <form method="dialog">
            <button class="btn">Batal</button>
        </form>
        </div>
    </div>
</dialog> 

{{-- single upload toast --}}
@if (session('status'))
<div class="toast toast-center" x-data="{ show: true }" x-show="show"  x-init="setTimeout(() => show = false, 5000)">
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
    id="multiupload-toast"
>
    <div class="flex items-center alert bg-green-300 border-none">
        <span x-text="message"></span>
        <button type="button" class="flex text-sm hover:text-black text-gray-800" @click="show = false">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
</div>

<x-modal name="upload-photo" :show="$errors->any()"  :closeOnOutsideClick="false" maxWidth="2xl">
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
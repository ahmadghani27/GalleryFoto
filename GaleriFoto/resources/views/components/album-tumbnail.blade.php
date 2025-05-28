@props(['folder'])

<div class="relative">
    <div class="aspect-square rounded-xl overflow-hidden">
        <div x-show="control" x-transition class="flex justify-between flex-col absolute w-full h-full">
            <div class="flex items-center justify-end">
                <div class="p-2 flex">
                    <label class="cursor-pointer label">
                        <input type="checkbox" class="checkbox checkbox-xl checkbox-primary" />
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-between bg-white w-full p-4">
                <div class="flex flex-col">
                    <div class="text-xl font-semibold text-black">{{ $folder->name_folder }}</div>
                    <div class="text-sm mt-1 font-light text-black opacity-80">
                        {{ $folder->created_at->format('d M Y') }}
                    </div>
                </div>
                <x-daisy-dropdown hoverClass="dark" colorClass="dark" x-data="{ isOpen: false }">
                    <x-daisy-dropdown-link
                        href="#"
                        onclick="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-nama-album' }))">
                        <span class="material-symbols-outlined">edit</span>
                        <span>Ganti nama</span>
                    </x-daisy-dropdown-link>
                    <x-daisy-dropdown-link
                        href="#"
                        onclick="event.preventDefault(); if(confirm('Yakin hapus album?')) { document.getElementById('delete-album-{{ $folder->id_folder }}').submit(); }">
                        <span class="material-symbols-outlined">delete</span>
                        <span>Hapus album</span>
                    </x-daisy-dropdown-link>
                </x-daisy-dropdown>
            </div>
        </div>
        <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover">
    </div>

    <!-- Form delete -->
    <form id="delete-album-{{ $folder->id_folder }}"
        action="{{ route('album.destroy', $folder->id_folder) }}"
        method="POST"
        style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>

<x-modal name="delete-album"
    maxWidth="sm"
    :show="$errors->has('delete_album')"
    :closeOnOutsideClick="false">
</x-modal>
                     



<x-modal name="edit-nama-album"
    maxWidth="sm"
    :show="$errors->has('nama_album')"
    :closeOnOutsideClick="false">
    <div class="p-6">
        <div class="flex-col gap-4">
            <div class="text-[20px] font-semibold">Ganti nama album</div>
            <div class="opacity-70">Ubah nama album dengan yang baru</div>
        </div>

        <form action="{{ route('album.update', $folder->id_folder) }}" method="POST"
            x-data="{ submitting: false, nama_album: '{{ old('nama_album', $folder->name_folder) }}' }"
            @submit.prevent="submitting = true; $el.submit()"
            x-init="
                window.addEventListener('reset-newnama_album', () => {
                    nama_album = '';
                });
            ">
            @csrf
            @method('PATCH')

            <div class="flex-col mt-6 items-center justify-items-center">
                <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-nama_album">
                    <div class="grid place-center">
                        <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">
                            match_case
                        </span>
                    </div>
                    <input type="text"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                            border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600"
                        value="{{ $folder->name_folder }}"
                        disabled placeholder="Nama album lama">
                </div>

                <span class="material-symbols-outlined mt-4 mb-4 shrink-0 text-2 text-gray-500 select-none">
                    swap_vert
                </span>

                <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full 
                    outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300">
                    <div class="grid place-center">
                        <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">
                            match_case
                        </span>
                    </div>
                    <input type="text" name="nama_album" id="nama_album" autocomplete="off"
                        x-model="nama_album"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 
                            border-none focus:outline-none focus:ring-0 focus:border-none shadow-none"
                        placeholder="Masukkan nama album baru"
                        required>
                </div>

                @error('nama_album')
                <p class="text-red-600 text-sm mt-1" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="flex justify-between gap-2 mt-4">
                <button type="button"
                    @click="show = false; window.dispatchEvent(new CustomEvent('reset-newnama_album'))"
                    :disabled="submitting"
                    class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">
                    Batal
                </button>
                <button type="submit" :disabled="submitting"
                    class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                    <template x-if="!submitting">
                        <span class="text-white">Simpan</span>
                    </template>
                    <template x-if="submitting">
                        <div role="status">
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 ... 9.08144 50.5908Z" fill="currentColor" />
                                <path d="M93.9676 39.0409C96.393 ... 93.9676 39.0409Z" fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </template>
                </button>
            </div>
        </form>
    </div>
</x-modal>
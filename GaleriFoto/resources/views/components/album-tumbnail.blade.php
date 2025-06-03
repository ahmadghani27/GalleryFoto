@props(['folder'])

<div class="relative group shadow-md">
    <div class="aspect-square rounded-lg overflow-hidden">
        <div class="absolute bottom-0 flex items-center justify-between bg-yellow-50 w-full p-4">
            <div class="flex flex-col">
                <div class="text-xl font-semibold text-black">{{ $folder->name_folder }}</div>
                <div class="text-sm mt-1 font-light text-black opacity-80">
                    {{ $folder->created_at->format('d M Y H:m:s') }}
                </div>
            </div>
            <x-daisy-dropdown hoverClass="dark" colorClass="dark" x-data="{ isOpen: false }">
                <x-daisy-dropdown-link
                    href="#"
                    onclick="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-nama-album-{{ $folder->id_folder }}' }))" class="hover:text-white">
                    <span class="material-symbols-outlined p-1">edit</span>
                    <span>Ganti nama</span>
                </x-daisy-dropdown-link>
                <x-daisy-dropdown-link
                    href="#"
                    onclick="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-modal', { detail: 'hapus-album-{{ $folder->id_folder }}' }))">
                    <span class="material-symbols-outlined p-1">delete</span>
                    <span>Hapus album</span>
                </x-daisy-dropdown-link>
            </x-daisy-dropdown>
        </div>
        @if ($folder->thumbnail)
        <a href="{{ route('album.show', $folder->id_folder) }}" class="block w-full h-full">
            <img src="{{ route('foto.access', $folder->thumbnail->file_path) }}"
                alt="Thumbnail album {{ $folder->name_folder }}"
                class="w-full h-full object-cover rounded-md shadow-md"
                loading="lazy">
        </a>
        @else
        <a href="{{ route('album.show', $folder->id_folder) }}"
            class="block bg-white w-full h-full"
            aria-label="Buka album {{ $folder->name_folder }}"
            @click.stop>
            <img src="{{ asset('assets/img/empty_album_placeholder.png') }}"
                alt="Thumbnail album {{ $folder->name_folder }}"
                class="w-full h-full object-cover rounded-md shadow-md"
                loading="lazy">
        </a>
        @endif
    </div>

    <form id="form-hapus-album-{{ $folder->id_folder }}"
        action="{{ route('album.destroy', Crypt::encryptString($folder->id_folder)) }}"
        method="POST"
        style="display:none;">
        @csrf
        @method('DELETE')
    </form>

</div>

<x-modal name="hapus-album-{{ $folder->id_folder }}"
    maxWidth="lg"
    :closeOnOutsideClick="false">
    <div class="w-full p-6 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 inline-flex flex-col gap-6">

        <div class="flex flex-col gap-3">
            <div class="text-black text-xl font-semibold">
                Hapus album “{{ $folder->name_folder }}”
            </div>
            <div class="text-black/70 text-base font-normal">
                Perhatian, tindakan ini tidak dapat dikembalikan.
            </div>
        </div>

        <div class="flex gap-2 w-full">
            {{-- Batal --}}
            <button type="button"
                @click="show = false"
                class="flex-1 h-14 px-2.5 py-5 rounded-2xl flex justify-center items-center gap-2.5 hover:bg-gray-100 transition">
                <div class="text-neutral-900 text-base font-bold">Batal</div>
            </button>


            <button type="submit"
                form="form-hapus-album-{{ $folder->id_folder }}"
                class="flex-1 h-14 px-2.5 py-5 bg-neutral-900/5 rounded-2xl flex justify-center items-center gap-2.5 hover:bg-red-100 transition">
                <div class="text-red-600 text-base font-bold">Hapus album</div>
            </button>
        </div>
    </div>
</x-modal>

<x-modal name="edit-nama-album-{{ $folder->id_folder }}"
    maxWidth="sm"
    :show="$errors->has('username')"
    :closeOnOutsideClick="false">
    <div class="p-6">
        <!-- Header -->
        <div class="flex-col gap-4">
            <div class="text-[20px] font-semibold">Ganti nama album</div>
            <div class="opacity-70">Ubah nama album "{{ $folder->name_folder }}" dengan yang baru</div>
        </div>

        <!-- Form -->
        <form action="{{ route('album.update', $folder->id_folder) }}" method="POST"
            x-data="{
                  submitting: false,
                  newName: '{{ old('username', $folder->name_folder) }}',
                  errors: {{ json_encode($errors->get('username')) }},
                  hasErrors: {{ $errors->has('username') ? 'true' : 'false' }}
              }"
            @submit.prevent="submitting = true; $el.submit()"
            @keydown.enter.prevent>
            @csrf
            @method('PATCH')

            <!-- Current Name (Disabled) -->
            <div class="flex-col mt-6 items-center justify-items-center">
                <!-- Input Nama Lama -->
                <div class="flex items-center gap-2 rounded-md bg-gray-100 px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300">
                    <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">
                        match_case
                    </span>
                    <input type="text"
                        disabled
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600"
                        value="{{ $folder->name_folder }}"
                        placeholder="Nama album lama">
                </div>

                <!-- Icon Panah -->
                <span class="material-symbols-outlined mt-4 mb-4 shrink-0 text-2 text-gray-500 select-none">
                    swap_vert
                </span>

                <!-- Input Nama Baru -->
                <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300">
                    <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">
                        match_case
                    </span>
                    <input type="text"
                        name="username"
                        id="username-{{ $folder->id_folder }}"
                        autocomplete="off"
                        x-model="username"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 border-none focus:outline-none focus:ring-0 focus:border-none shadow-none"
                        placeholder="Masukkan nama album baru"
                        required>
                </div>

                <!-- Error Message -->
                @error('username-{{ $folder->id_folder }}')
                <p class="text-red-600 text-sm mt-1" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 mt-6">
                <button type="button"
                    @click="$dispatch('close-modal', 'edit-nama-album-{{ $folder->id_folder }}'); window.dispatchEvent(new CustomEvent('reset-newusername-{{ $folder->id_folder }}'))"
                    :disabled="submitting"
                    class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">
                    Batal
                </button>
                <button type="submit"
                    :disabled="submitting"
                    class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                    <template x-if="!submitting">
                        <span class="text-white">Simpan</span>
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
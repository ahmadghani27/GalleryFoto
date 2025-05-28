@props(['folder'])

<div class="relative">
    <div class="aspect-square rounded-xl overflow-hidden">
        <div x-show="control" x-transition class="flex justify-between flex-col absolute w-auto h-auto">
            <div class="flex items-center justify-end">
                <div class="p-2 flex">
                    <label class="cursor-pointer label">
                        <input type="checkbox" class="checkbox checkbox-xl checkbox-primary" />
                    </label>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 flex items-center justify-between bg-white w-full p-4">
            <div class="flex flex-col">
                <div class="text-xl font-semibold text-black">{{ $folder->name_folder }}</div>
                <div class="text-sm mt-1 font-light text-black opacity-80">
                    {{ $folder->created_at->format('d M Y') }}
                </div>
            </div>
            <x-daisy-dropdown hoverClass="dark" colorClass="dark" x-data="{ isOpen: false }">
                <x-daisy-dropdown-link
                    href="#"
                    onclick="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-nama-album-{{ $folder->id_folder }}' }))">
                    <span class="material-symbols-outlined">edit</span>
                    <span>Ganti nama</span>
                </x-daisy-dropdown-link>
                <x-daisy-dropdown-link
                    href="#"
                    onclick="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-modal', { detail: 'hapus-album-{{ $folder->id_folder }}' }))">
                    <span class="material-symbols-outlined">delete</span>
                    <span>Hapus album</span>
                </x-daisy-dropdown-link>
            </x-daisy-dropdown>
        </div>
        @if($folder->photos->first())
        <a href="{{ route('album.show', $folder->id_folder) }}"
            class="block w-full h-full z-10"
            aria-label="Buka album {{ $folder->name_folder }}"
            @click.stop>
            <img src="{{ asset('storage/'.$folder->photos->first()->file_path) }}"
                alt="{{ $folder->photos->first()->photo_title }}"
                class="w-full h-full object-cover">
        </a>
        @else
        <a href="{{ route('album.show', $folder->id_folder) }}"
            class="block w-full h-full z-10"
            aria-label="Buka album {{ $folder->name_folder }}"
            @click.stop>
            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <span class="material-symbols-outlined text-4xl text-gray-400">photo_library</span>
            </div>
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
    :show="$errors->has('username-{{ $folder->id_folder }}')"
    :closeOnOutsideClick="false">
    <div class="p-6">
        <div class="flex-col gap-4">
            <div class="text-[20px] font-semibold">Ganti nama album</div>
            <div class="opacity-70">Ubah nama album "{{ $folder->name_folder }}" dengan yang baru</div>
        </div>

        <form action="{{ route('album.update', $folder->id_folder) }}" method="POST"
            x-data="{ submitting: false, username: '{{ old('username-' . $folder->id_folder, $folder->name_folder) }}' }"
            @submit.prevent="submitting = true; $el.submit()"
            x-init="
                  window.addEventListener('reset-newusername-{{ $folder->id_folder }}', () => {
                      username = '';
                  });
              ">
            @csrf
            @method('PATCH')

            <div class="flex-col mt-6 items-center justify-items-center">
                <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300">
                    <div class="grid place-center">
                        <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">
                            match_case
                        </span>
                    </div>
                    <input type="text"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                               border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600"
                        value="{{ $folder->name_folder }}"
                        disabled
                        placeholder="Nama album lama">
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
                    <input type="text"
                        name="username-{{ $folder->id_folder }}"
                        id="username-{{ $folder->id_folder }}"
                        autocomplete="off"
                        x-model="username"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 
                               border-none focus:outline-none focus:ring-0 focus:border-none shadow-none"
                        placeholder="Masukkan nama album baru"
                        required>
                </div>

                @error('username-{{ $folder->id_folder }}')
                <p class="text-red-600 text-sm mt-1" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="flex justify-between gap-2 mt-4">
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
                            <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 ... 9.08144 50.5908Z" fill="currentColor" />
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
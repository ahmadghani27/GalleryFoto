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
                        @click.prevent="isOpen = false; window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-nama-album' }))">
                        <span class="material-symbols-outlined">edit</span>
                        <span>Ganti nama</span>
                    </x-daisy-dropdown-link>
                    <x-daisy-dropdown-link
                        href="#"
                        @click.prevent="if(confirm('Yakin hapus album?')) {
            isOpen = false;
            document.getElementById('delete-album-{{ $folder->id_folder }}').submit();
        }">
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

<x-modal name="edit-nama-album"
    maxWidth="sm"
    :show="$errors->has('username')"
    :closeOnOutsideClick="false">
    <div class="p-6">
        <div class="flex-col gap-4">
            <div class="text-[20px] font-semibold">Ganti username</div>
            <div class="opacity-70">Ini tanda pengenal anda, harus unik!</div>
        </div>

        <form action="{{ route('album.update', $folder->id_folder) }}" method="POST"
            x-data="{ submitting: false }"
            @submit.prevent="submitting = true; $el.submit()">
            @csrf
            @method('PATCH')
            <div class="flex-col mt-6 items-center justify-items-center">
                <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300">
                    <div class="grid place-center">
                        <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">folder_open</span>
                    </div>
                    <input type="text"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                          border-none focus:outline-none focus:ring-0 focus:border-none shadow-none"
                        value="{{ $folder->name_folder }}"
                        name="name"
                        placeholder="Masukkan nama album baru"
                        required>
                </div>
                @error('name')
                <p class="text-red-600 text-sm mt-1" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="flex justify-between gap-2 mt-4">
                <button type="button"
                    @click="$dispatch('close-modal', 'edit-nama-album')"
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
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
                <x-daisy-dropdown hoverClass="dark" colorClass="dark">
                    <x-daisy-dropdown-link href="#">
                        <span class="material-symbols-outlined">edit</span>
                        <span>Ganti nama</span>
                    </x-daisy-dropdown-link>
                    <x-daisy-dropdown-link
                        href="#"
                        x-data="{}"
                        @click.prevent="if(confirm('Yakin hapus album?')) {
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
<div class="relative" x-data="{ control : false }" @mouseleave="control = false">
    <div class="aspect-square rounded-sm overflow-hidden" @mouseenter="control = true">
        <div x-show="control" x-transition class="flex justify-between flex-col p-4 absolute bg-gradient-to-t from-gray-900/50 from-10% via-gray-900/0 via-30% to-gray-900/50 to-90% w-full h-full ">
            <div class="flex items-center justify-between">
                <div x-data="{ loved : false }">
                    <button type="button" class="p-2 flex rounded-md bg-gray-200"  @click="loved = !loved">
                        <span class="icon-filled material-symbols-outlined" :class="{'!text-red-500': loved }">favorite</span>
                    </button>
                </div>
                <div class="p-2 flex">
                    <label class="cursor-pointer label">
                        <input type="checkbox" class="p-3 rounded-md cursor-pointer bg-transparent border-white border-[2px]" />
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <div class="text-xl font-semibold text-white">{{ 'Pantai Kiri' }}</div>
                    <div class="text-sm mt-1 font-light text-white opacity-80">{{ '20 Mei 2025' }}</div>
                </div>
                <x-daisy-dropdown >
                    <x-daisy-dropdown-link href="">
                        <span class="material-symbols-outlined">folder_open</span>
                        <span>Pindah ke album</span>
                    </x-daisy-dropdown-link>    
                    <x-daisy-dropdown-link href="" class="">
                        <span class="material-symbols-outlined">edit</span>
                        <span>Ganti judul</span>
                    </x-daisy-dropdown-link>    
                    <x-daisy-dropdown-link href="">
                        <span class="material-symbols-outlined">archive</span>
                        <span>Arsipkan</span>
                    </x-daisy-dropdown-link>    
                    <x-daisy-dropdown-link href="">
                        <span class="material-symbols-outlined">delete</span>
                        <span>Hapus foto</span>
                    </x-daisy-dropdown-link>    
                </x-daisy-dropdown>
            </div>
        </div>
        <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover ">
    </div>
</div>


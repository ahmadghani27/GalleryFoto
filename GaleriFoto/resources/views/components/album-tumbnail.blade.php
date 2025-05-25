<div class="relative">
    <div class="aspect-square rounded-xl overflow-hidden" >
        <div x-show="control" x-transition class="flex justify-between flex-col absolute w-full h-full ">
            <div class="flex items-center justify-end" >
                <div class="p-2 flex" >
                    <label class="cursor-pointer label">
                        <input type="checkbox" class="checkbox checkbox-xl checkbox-primary" />
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-between bg-white w-full p-4">
                <div class="flex flex-col">
                    <div class="text-xl font-semibold text-black">{{ 'Pantai Kiri' }}</div>
                    <div class="text-sm mt-1 font-light text-black opacity-80">{{ '20 Mei 2025' }}</div>
                </div>
                <x-daisy-dropdown>
                    <x-daisy-dropdown-link href="">
                        <span class="material-symbols-outlined">Edit</span>
                        <span>Ganti nama</span>
                    </x-daisy-dropdown-link>    
                    <x-daisy-dropdown-link href="">
                        <span class="material-symbols-outlined">delete</span>
                        <span>Hapus album</span>
                    </x-daisy-dropdown-link>    
                </x-daisy-dropdown>
            </div>
        </div>
        <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover ">
    </div>
</div>


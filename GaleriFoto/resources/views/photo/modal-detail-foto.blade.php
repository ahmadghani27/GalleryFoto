<x-modal-full name="detail-foto-modal" :closeOnOutsideClick="true"  maxWidth="6xl">
    <div class="detail-foto-modal flex flex-col gap-5 p-4" 
        x-data="{
            isArsip : window.location.pathname.startsWith('/arsip')
        }"
        >
        <meta name="detail-foto-modal-id-foto" class="detail-foto-modal-id-foto">
        <div class="flex items-center justify-between">
            <span class="ml-4 font-semibold text-xl detail-foto-modal-title"></span>
            <div class="flex gap-3">
                <button type="button" class="modal-detail-favorit-btn flex gap-3 px-5 py-3 w-full hover:bg-gray-200 border-2 border-gray-100 rounded-md transition-all ease-in-out"
                    @click.stop="
                        const el = $event.currentTarget.closest('.detail-foto-modal');
                        const id = el.querySelector('.detail-foto-modal-id-foto').content;

                        const targetCard = Array.from(document.querySelectorAll('.cardFoto')).find(card => {
                            const idInput = card.querySelector('.id_carrier');
                            return idInput && idInput.value === id;
                        });

                        fetch('{{ route('foto.togglefavorite') }}', {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ id_foto: id })
                        })
                        .then(res => res.json())
                        .then(data => {
                            document.querySelector('.detail-foto-favorit').classList.toggle('text-red-500', data.is_favorite);
                            targetCard._x_dataStack[0].loved = data.is_favorite;
                            if (window.location.pathname.startsWith('/favorit')) {
                                window.location.reload();
                            }
                        })
                        .catch(err => console.error(err));
                    ">
                    <span class="material-symbols-outlined icon-filled detail-foto-favorit">favorite</span>
                    <span class="font-medium">Favorit</span>
                </button>
                <button x-show="!isArsip" type="button" class="modal-detail-arsipkan-btn flex gap-3 px-5 py-3 w-full hover:bg-gray-200 border-2 border-gray-100 rounded-md transition-all ease-in-out">
                    <span class="material-symbols-outlined">archive</span>
                    <span class="font-medium">Arsipkan</span>
                </button>
                <dialog id="modal-detail-arsipkan" class="modal">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Arsipkan <span id="fotoTitle" class="text-lg"></span></h3>
                        <p class="">Personalkan momen pribadi anda</p>
                        <div class="modal-action flex-col">
                            <form action="{{ route('arsipkanRaw') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id_photo" class="id_photo">
                                <button type="submit" class="modal-detail-arsipkan-confirm btn btn-neutral w-full">Arsipkan</button>
                            </form>
                            <form method="dialog">
                                <button class="btn w-full">Batal</button>
                            </form>
                        </div>
                    </div>
                </dialog>
                <button x-show="isArsip" type="button" class="modal-detail-unarsipkan-btn flex gap-3 px-5 py-3 w-full hover:bg-gray-200 border-2 border-gray-100 rounded-md transition-all ease-in-out">
                    <span class="material-symbols-outlined">unarchive</span>
                    <span class="font-medium whitespace-nowrap">Un-arsip</span>
                </button>
                <dialog id="modal-detail-unarsipkan" class="modal">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Un-arsipkan <span id="unarsipTitle" class="text-lg"></span></h3>
                        <p class="">Publikan kembali foto anda</p>
                        <div class="modal-action flex-col">
                            <form action="{{ route('unarsipkanRaw') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id_photo" class="id_photo">
                                <button type="submit" class="modal-detail-unarsipkan-confirm btn btn-neutral w-full">Un-arsipkan</button>
                            </form>
                            <form method="dialog">
                                <button class="btn w-full">Batal</button>
                            </form>
                        </div>
                    </div>
                </dialog>
                <button type="button" class="modal-detail-download-btn flex gap-3 px-5 py-3 w-full hover:bg-sky-600 rounded-md transition-all ease-in-out bg-black text-white">
                    <span style="color: inherit" class="material-symbols-outlined">download</span>
                    <span style="color: inherit" class="font-medium">Download</span>
                </button>
            </div>
        </div>
        <div class="aspect-video relative overflow-hidden">
            <div name="thumbnail" class="absolute z-20 aspect-square rounded-xl w-36 m-4 overflow-hidden shadow-md">
                <span class="absolute z-20 text-sm bg-transparent left-1/2 top-1/2 -translate-y-1/2 transform -translate-x-1/2 text-white">Thumbnail</span>
                <div class="absolute z-10 w-full h-full bg-black opacity-20"></div>
                <img src="" alt="" class="object-cover object-center w-full h-full detail-foto-thumbnail-foto">    
            </div>
            <img src="" alt="" class="object-contain right-0 left-0 absolute inset-0 h-full w-full detail-foto-full-foto">
        </div>
        <div class="flex items-center justify-between">
            <div class="flex gap-5 items-center ml-4">
                <div class="flex flex-col">
                    <span class="text-gray-400">Ditambahkan pada</span>
                    <span class="font-medium detail-foto-created-at"></span>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-400">Ukuran</span>
                    <span class="font-medium detail-foto-file-size"></span>
                </div>
            </div>
            <div class="flex gap-3">
                <button x-show="!isArsip" type="button" class="modal-detail-album-btn modal-detail-album-btn flex gap-3 px-5 py-3 w-full hover:bg-gray-200 border-2 border-gray-100 rounded-md transition-all ease-in-out whitespace-nowrap">
                    <span class="material-symbols-outlined">folder_open</span>
                    <span class="font-medium">Pindah ke album</span>
                </button>
                <button type="button" class="modal-detail-delete-btn flex gap-3 px-5 py-3 w-full hover:bg-gray-200 border-2 border-gray-100 rounded-md transition-all ease-in-out whitespace-nowrap">
                    <span class="material-symbols-outlined">delete</span>
                    <span class="font-medium">Hapus foto</span>
                </button>
                <dialog id="modal-detail-delete" class="modal">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Hapus foto</h3>
                        <p class="py-4">Perhatian! tindakan ini tidak dapat dikembalikan</p>
                        <div class="modal-action">
                        <form method="POST" action="{{ route('deleteRaw') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" class="id_photo" name="id_photo">
                            <button type="submit" class="btn btn-neutral">Hapus</button>
                        </form>
                        <form method="dialog">
                            <button class="btn">Batal</button>
                        </form>
                        </div>
                    </div>
                </dialog> 
            </div>
        </div>
    </div>
</x-modal-full>
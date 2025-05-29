<dialog id="modalEdit" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Ganti Judul</h3>
        <p class="py-2">Ubah judul foto dengan yang baru</p>
        <div class="modal-action flex-col">
        <form method="POST" action="{{ route('foto.editjudul') }}">
            @csrf
            @method('PATCH')
            <div class="flex-col items-center justify-items-center">
                <input type="hidden" id="editId" name="id_foto">

                <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username">
                            
                    <div class="grid place-center">
                        <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">match_case</span>
                    </div>

                    <input type="text" id="editTitle" name="title_foto"
                    class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                            border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600"
                    disabled>

                </div>
                <span class="material-symbols-outlined mt-4 mb-4 shrink-0 text-2 text-gray-500 select-none">swap_vert</span>
                <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username">
                            
                    <div class="grid place-center">
                        <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">match_case</span>
                    </div>

                    <input type="text" name="new_judul"
                    class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                            border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600" placeholder="Judul baru">
                </div>
            </div>
            <hr class="mt-4">
            <button type="submit" class="btn btn-neutral w-full mt-4">Ganti judul</button>
        </form>
        <form method="dialog">
            <button class="btn w-full">Batal</button>
        </form>
        </div>
    </div>
</dialog> 
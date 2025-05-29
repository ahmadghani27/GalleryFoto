<dialog id="modalDelete" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Hapus foto</h3>
        <p class="py-4">Perhatian! tindakan ini tidak dapat dikembalikan</p>
        <div class="modal-action">
        <form method="POST" action="{{ route('foto.singledelete') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" id="deleteId" name="id_foto">
            <button type="submit" class="btn btn-neutral">Hapus</button>
        </form>
        <form method="dialog">
            <button class="btn">Batal</button>
        </form>
        </div>
    </div>
</dialog> 
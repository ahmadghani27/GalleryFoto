<dialog id="modalArsip" class="modal">
    <div class="modal-box rounded-xl">
        <h3 class="text-lg font-bold">Arsipkan</h3>
        <p class="py-2">Perhatian! tindakan ini tidak dapat dikembalikan</p>
        <div class="modal-action">
        <form method="POST" action="{{ route('foto.singlearsip') }}">
            @csrf
            @method('PATCH')
            <input type="hidden" id="arsipId" name="id_foto">
            <button type="submit" class="btn btn-neutral">Arsipkan</button>
        </form>
        <form method="dialog">
            <button class="btn">Batal</button>
        </form>
        </div>
    </div>
</dialog> 
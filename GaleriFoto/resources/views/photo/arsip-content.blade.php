<div class="block p-6">
    <h2 class="text-xl font-bold mb-6">Foto Arsip</h2>

    @php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
    @endphp

    @if($arsipFoto->isEmpty())
    <div class="text-center py-10">
        <p class="text-gray-500">Tidak ada foto di arsip</p>
    </div>
    @else
    @foreach($arsipFoto as $tanggal => $fotos)
    <div class="mb-8">
        <h3 class="text-lg font-semibold mb-4">{{ $tanggal }}</h3>
        <div class="grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
            @foreach($fotos as $ft)
            <x-photo-tumbnail
                :path="$ft->file_path"
                :title="$ft->photo_title"
                :date="$ft->created_at"
                :photoId="$ft->id_photo"
                :isLoved="$ft->is_favorite">
                <x-daisy-dropdown>
                    <button type="button">
                        <span class="material-symbols-outlined">folder_open</span>
                        <span>Pindah ke album</span>
                    </button>
                    <button type="button" class="editJudul flex gap-3" onclick="document.getElementById('modalEdit').showModal()">
                        <input type="hidden" class="title_foto" value="{{ $ft->photo_title }}">
                        <input type="hidden" class="id_foto" value="{{ Crypt::encryptString($ft->id_photo) }}">
                        <span class="material-symbols-outlined">edit</span>
                        <span>Ganti judul</span>
                    </button>
                    <button type="button" class="arsipkanFoto flex gap-3" onclick="arsipkanFoto('{{ Crypt::encryptString($ft->id_photo) }}')">
                        <input type="hidden" class="jj" value="{{ Crypt::encryptString($ft->id_photo) }}">
                        <span class="material-symbols-outlined">unarchive</span>
                        <span>Keluarkan dari Arsip</span>
                    </button>
                    <button type="button" class="deleteFoto flex gap-3" onclick="document.getElementById('modalDelete').showModal()">
                        <input type="hidden" class="jj" value="{{ Crypt::encryptString($ft->id_photo) }}">
                        <span class="material-symbols-outlined">delete</span>
                        <span>Hapus foto</span>
                    </button>
                </x-daisy-dropdown>
            </x-photo-tumbnail>
            @endforeach
        </div>
    </div>
    @endforeach
    @endif
</div>

@push('scripts')
<script>
    function arsipkanFoto(photoId) {
        fetch('{{ route('
                photo.archive ') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        photo_id: photoId,
                        is_archive: false
                    })
                })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            });
    }
</script>
@endpush
@extends('layouts.sidebar')
@section('title', 'Arsip')

@section('content')
<div class="flex flex-col bg-white">
    <div class="sticky top-0 z-40 px-6 py-3 pt-6 bg-white border-b-[1.5px] border-gray-200">
        <div class="flex gap-5">
            <div class="flex-1 py-1 px-5 bg-white rounded-full border-[1.5px] border-gray-300 flex justify-between items-center">
                <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input
                        type="search"
                        value="Monyet"
                        class="text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0"
                        placeholder="Cari foto..." />
                </div>
            </div>
            <button type="button" class="cursor-pointer p-3 !bg-black rounded-full flex items-center gap-2 pr-4"
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))">
                <span class="material-symbols-outlined text-gray-300">
                    add
                </span>
                <span class="text-gray-300 font-semibold">Tambah Foto</span>
            </button>
        </div>
        <div class="w-full flex items-center mt-3 gap-6">
            <div class="flex justify-end items-center gap-5">
                <div x-data="{ open: false, selected: new URLSearchParams(window.location.search).get('sort') === 'asc' ? 'Terlama' : 'Terbaru' }" class="relative">
                    <div
                        @click="open = !open" :class="{'rounded-t-md': open, 'rounded-full': !open}"
                        class="cursor-pointer px-5 py-3 !bg-white border-[1.5px] border-gray-300 rounded-full flex justify-start items-center gap-2
                        ">
                        <span class="material-symbols-outlined cursor-pointer">
                            format_line_spacing
                        </span>
                        <div x-text="selected" class="text-neutral-900 text-base font-normal font-inter group-hover:text-white"></div>
                    </div>

                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute top-full left-0 w-full bg-transparent">
                        <div class="flex flex-col">
                            <template x-if="selected === 'Terbaru'">
                                <a
                                    href="{{ route('foto', ['sort' => 'asc']) }}"
                                    @click="selected = 'Terlama'; open = false"
                                    class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] ">
                                    Terlama
                                </a>
                            </template>
                            <template x-if="selected === 'Terlama'">
                                <a
                                    href="{{ route('foto', ['sort' => 'desc']) }}"
                                    @click="selected = 'Terbaru'; open = false"
                                    class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] ">
                                    Terbaru
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" text-gray-500 text-md font-normal font-inter bg-white/80 backdrop-blur-lg">Menampilkan Foto
            </div>
        </div>
    </div>
    <div class="block px-6 bg-gray-100">
        <h2 class="text-xl font-bold mb-6">Foto Arsip</h2>

        @if(!isset($arsipFoto) || $arsipFoto->isEmpty())
        <div class="text-center py-10">
            <p class="text-gray-500">Tidak ada foto di arsip</p>
        </div>
        @else
        @foreach($arsipFoto as $tanggal => $groupedPhotos)
        <div class="mb-8">
            <h3 class="text-lg font-semibold mb-4">{{ $tanggal }}</h3>
            <div class="grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-3 justify-items-start max-w-full md:justify-items-stretch">
                @foreach($groupedPhotos as $photo)
                <x-photo-tumbnail
                    :path="$photo->file_path"
                    :title="$photo->photo_title"
                    :date="$photo->created_at"
                    :photoId="$photo->id_photo"
                    :isLoved="$photo->is_favorite">
                    <x-daisy-dropdown>
                        <button type="button">
                            <span class="material-symbols-outlined">folder_open</span>
                            <span>Pindah ke album</span>
                        </button>
                        <button type="button" class="editJudul flex gap-3" onclick="document.getElementById('modalEdit').showModal()">
                            <input type="hidden" class="title_foto" value="{{ $photo->photo_title }}">
                            <input type="hidden" class="id_foto" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <span class="material-symbols-outlined">edit</span>
                            <span>Ganti judul</span>
                        </button>
                        <form action="{{ route('photos.unarchive') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="id_foto" value="{{ Crypt::encryptString($photo->id_photo) }}">
                            <button type="submit"
                                class="unarsipkanFoto flex gap-3 items-center px-3 py-2 hover:bg-gray-100 rounded-lg text-sm"
                                onclick="return confirm('Yakin ingin mengeluarkan foto ini dari arsip?')">
                                <span class="material-symbols-outlined text-yellow-600">unarchive</span>
                                <span>Keluarkan dari Arsip</span>
                            </button>
                        </form>

                        <button type="button" class="deleteFoto flex gap-3" onclick="document.getElementById('modalDelete').showModal()">
                            <input type="hidden" class="jj" value="{{ Crypt::encryptString($photo->id_photo) }}">
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
</div>

@endsection

@push('scripts')
<script>
    function arsipkanFoto(encryptedId) {
        if (!confirm('Apakah Anda yakin ingin mengeluarkan foto ini dari arsip?')) {
            return;
        }

        const btn = event.target.closest('button');
        btn.disabled = true;
        btn.querySelector('span:last-child').textContent = 'Memproses...';

        fetch(`/photos/${encryptedId}/unarchive`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Refresh halaman atau hilangkan elemen foto
                    window.location.reload();
                } else {
                    alert(data.message);
                    btn.disabled = false;
                    btn.querySelector('span:last-child').textContent = 'Keluarkan dari Arsip';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
                btn.disabled = false;
                btn.querySelector('span:last-child').textContent = 'Keluarkan dari Arsip';
            });
    }
</script>
@endpush
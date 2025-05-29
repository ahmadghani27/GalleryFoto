<!-- resources/views/photo/arsip-content.blade.php -->
<div class="py-6">
    <h2 class="text-xl font-bold mb-4">Foto Arsip</h2>

    @php
    $userId = Auth::id();
    $sortOrder = request('sort', 'desc');
    $arsipFoto = App\Models\Photo::where('user_id', $userId)
    ->where('is_archive', true)
    ->orderBy('created_at', $sortOrder)
    ->get()
    ->groupBy(function ($item) {
    $tanggal = Carbon::parse($item->created_at);

    if ($tanggal->isToday()) {
    return 'Hari ini';
    } elseif ($tanggal->isYesterday()) {
    return 'Kemarin';
    } else {
    return $tanggal->translatedFormat('d M Y');
    }
    });
    @endphp

    @foreach($arsipFoto as $tanggal => $fotos)
    <div class="mb-8">
        <h3 class="text-lg font-semibold mb-4">{{ $tanggal }}</h3>
        <div class="grid grid-cols-3 gap-4">
            @foreach($fotos as $foto)
            <!-- Tampilkan foto arsip -->
            <div class="relative group">
                <img src="{{ asset('storage/' . $foto->path) }}"
                    alt="Foto arsip"
                    class="w-full h-48 object-cover rounded-lg">
                <!-- Tombol aksi dll -->
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
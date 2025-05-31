@props([
'path' => 'sample-photo.jpg',
'title' => 'Judul Default',
'photoId' => 'ss',
'date' => now()->format('d M Y'),
'isLoved' => false,
])

<div class="bg-white cardFoto rounded-lg overflow-hidden relative" x-data="{ leave : false, control : false, loved: {{ $isLoved ? 'true' : 'false' }} }" @mouseleave="if (!leave) control = false">
    <div class="aspect-square rounded-sm overflow-hidden" @mouseenter="control = true">

        <img src="{{ route('foto.access', ['path' => $path ]) }}" alt="{{ $title }}" class="w-full h-full object-cover " loading="lazy">
    </div>
</div>
@props([
'colorClass' => 'default',
'hoverClass' => 'default',
'contentClasses' => 'py-1 bg-white'
])

@php
$colorClass = match ($colorClass) {
'dark' => 'text-gray-900',
default => 'text-white',
};

$hoverClass = match ($hoverClass) {
'dark' => 'hover:text-white',
default => 'hover:text-gray-900',
};
@endphp

<div class="dropdown dropdown-top dropdown-end group">
    <div tabindex="0" role="button"
        class="p-2 flex rounded-md hover:bg-gray-200 transition-all ease-in-out">
        <span class="material-symbols-outlined {{ $colorClass }} {{ $hoverClass }} transition-all ease-in-out">
            more_vert
        </span>
    </div>
    <ul class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm {{ $contentClasses }} group-hover:block hidden">
        {{ $slot }}
    </ul>
</div>
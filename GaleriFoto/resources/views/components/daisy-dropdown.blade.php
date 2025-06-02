@props([
'colorClass' => 'dark',
'hoverClass' => 'dark',
'hoverBg' => 'dark',
'contentClasses' => 'py-1 bg-white'
])

@php
$colorClass = match ($colorClass) {
'dark' => 'text-cyan-600',
'default' => 'text-white',
};

$hoverClass = match ($hoverClass) {
'dark' => 'hover:text-white',
'default' => 'hover:text-cyan-600',
};

@endphp

<div x-data="{ open: false }" {{ $attributes->merge(['class' => 'dropdown dropdown-top dropdown-end']) }}
    :class="{ 'dropdown-open': open }"
    @click.outside="open = false">
    <div class="dropdown dropdown-top dropdown-end group bg-cyan">
        <div tabindex="0" role="button"
            class="w-10 flex items-center justify-end transition-all ease-in-out x-33">
            <span class="material-symbols-outlined {{ $colorClass }} {{ $hoverClass }} transition-all ease-in-out w-full h-10 p-2 hover:bg-cyan-600 rounded-md">
                more_vert
            </span>
        </div>
        <ul class="dropdown-content menu bg-base-100 rounded-box w-52 py-2 shadow-md {{ $contentClasses }} group-hover:block hidden">
            {{ $slot }}
        </ul>
    </div>
</div>

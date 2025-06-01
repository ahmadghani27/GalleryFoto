@props([
    'name',
    'show' => false,
    'maxWidth' => 'xl',
    'closeOnOutsideClick' => true,
    'outsideCloseBtn' => true,
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '3xl' => 'sm:max-w-3xl',
    '4xl' => 'sm:max-w-4xl',
    '6xl' => 'sm:max-w-6xl',
    'auto' => 'auto',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        closeOnOutsideClick: @js($closeOnOutsideClick),
        outsideCloseBtn: @js($outsideCloseBtn),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <!-- Backdrop -->
    <div
        x-show="show"
        class="fixed inset-0 bg-gray-700 opacity-75 transition-opacity"
        x-on:click="if(closeOnOutsideClick) window.dispatchEvent(new CustomEvent('close-modal', { detail: 'detail-foto-modal' }));"
        {{-- x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" --}}
    ></div>

    <div
        class="min-h-full flex items-center justify-center sm:p-0"
        x-show="show"
        {{-- x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" --}}
    >
        <!-- Modal container -->
        <button class="detail-foto-close-btn m-4 fixed top-0 grid place-center left-0 rounded-full" @click="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'detail-foto-modal' }));">
            <span class="material-symbols-outlined text-white/70 hover:text-white text-2xl">close</span>
        </button>

        <div class="py-6 px-3 fixed top-1/2 left-10 transform -translate-y-1/2">
            <button class="detail-foto-backward-btn disabled:opacity-20">
                <span class="material-symbols-outlined text-white/70 hover:text-white text-2xl transition-all ease-in-out">arrow_back_ios</span>
            </button>
        </div>

        <div
            class="bg-white rounded-2xl overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} min-w-[84%] sm:mx-auto"
        >
            {{ $slot }}
        </div>

        <div class="py-6 px-3 fixed top-1/2 right-10 transform -translate-y-1/2">
            <button class="detail-foto-forward-btn disabled:opacity-20">
                <span class="material-symbols-outlined text-white/70 hover:text-white text-2xl transition-all ease-in-out">arrow_forward_ios</span>
            </button>
        </div>
    </div>
</div>

@extends("layouts.sidebar")
@section("title", "Foto")

@section("content")
<div class="flex h-full w-full flex-col bg-white">
    <div
        class="sticky top-0 z-40 min-h-[89px] h-auto w-full bg-white px-6 py-5 transition-all ease-in-out">
        <div
            class="infoFilter flex w-full items-center gap-4"
            x-cloak
            x-data="{ show: true }"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="translate-x-4 opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition duration-200 ease-in"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="-translate-x-4 opacity-0"
            x-show="show">
            <div class="flex w-full items-center justify-end gap-3">
                <div
                    class="flex w-full flex-1 items-center justify-between rounded-full border-[1.5px] border-cyan-600 bg-white pl-5 pr-3 focus-within:border-cyan-600 focus-within:outline-none focus-within:ring-1 focus-within:ring-cyan-600">
                    <div
                        class="flex h-12 w-full items-center justify-start gap-4">
                        <span
                            class="material-symbols-outlined text-cyan-600">
                            search
                        </span>
                        <input
                            id="searchFotoField"
                            type="text"
                            value="{{ request("search") }}"
                            class="searchFoto text-neutral-900 font-inter h-full w-full border-none bg-transparent text-lg font-normal outline-none focus:outline-none focus:ring-0"
                            placeholder="Cari foto anda" />

                        <button
                            id="clearSearchBtn"
                            type="button"
                            class="clearSearchBtn {{ $search ? "" : "hidden" }} h-full"
                            aria-label="Clear search">
                            <span
                                class="material-symbols-outlined flex h-full items-center px-2 text-red-600 hover:text-cyan-600">
                                close
                            </span>
                        </button>
                    </div>
                </div>
                @if (! empty($search))
                <div
                    class="text-md flex gap-2 rounded-full bg-slate-100 px-4 py-3 font-semibold">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <span class="pr-1">{{ $search }}</span>
                </div>
                @endif
                <div
                    x-data="{
                            open: false,
                            selected:
                                new URLSearchParams(window.location.search).get('sort') === 'asc'
                                    ? 'Terlama'
                                    : 'Terbaru',
                        }"
                    class="relative">
                    <div
                        @click="open = !open"
                        :class="{'rounded-t-2xl': open, 'rounded-full': !open}"
                        class="flex cursor-pointer items-center justify-start gap-2 rounded-full border-[1.5px] border-gray-300 !bg-cyan-600 px-5 py-3">
                        <span
                            class="material-symbols-outlined cursor-pointer text-white">
                            format_line_spacing
                        </span>
                        <div
                            x-text="selected"
                            class="text-neutral-900 font-inter text-base font-normal text-white group-hover:text-white"></div>
                    </div>

                    <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute left-0 top-full w-full bg-transparent">
                        <div class="flex flex-col">
                            <template x-if="selected === 'Terbaru'">
                                <a
                                    href="{{ route("foto", ["sort" => "asc"]) }}"
                                    @click="selected = 'Terlama'; open = false"
                                    class="text-neutral-900 font-inter rounded-b-2xl border-[1.5px] border-gray-300 bg-white px-5 py-3 text-center text-base font-normal transition-colors duration-200 hover:bg-cyan-600 hover:text-white">
                                    Terlama
                                </a>
                            </template>
                            <template x-if="selected === 'Terlama'">
                                <a
                                    href="{{ route("foto", ["sort" => "desc"]) }}"
                                    @click="selected = 'Terbaru'; open = false"
                                    class="text-neutral-900 font-inter rounded-b-2xl border-[1.5px] border-gray-300 bg-white px-5 py-3 text-center text-base font-normal transition-colors duration-200 hover:bg-cyan-600 hover:text-white">
                                    Terbaru
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
                <button
                    type=" button"
                    class="flex cursor-pointer items-center justify-center gap-2 rounded-full !bg-cyan-600 p-3"
                    onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))"
                    x-data="{ open: true }"
                    x-init="open = window.innerWidth >= 768"
                    @resize.window="open = window.innerWidth >= 900">
                    <span
                        class="material-symbols-outlined text-white"
                        :class="open ? '' : 'w-9'">
                        add
                    </span>
                    <span
                        class="font-semibold text-white"
                        :class="open ? 'pr-3' : 'hidden'">
                        Tambah Foto
                    </span>
                </button>
            </div>
        </div>

        <div
            x-data="{ show: false }"
            x-show="show"
            x-cloak
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="translate-x-4 opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition duration-200 ease-in"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="-translate-x-4 opacity-0"
            class="massActionPanel flex w-full items-center justify-between">
            <div class="flex items-center">
                <button
                    class="cardBlockBtn flex rounded-xl p-2 transition-all ease-in-out hover:bg-gray-100">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="ml-2">
                    <span class="cardCounter font-semibold"></span>
                    foto diseleksi
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="massPindahAlbumBtn flex gap-2 rounded-xl bg-gray-100 p-3 px-4 transition-all ease-in-out hover:bg-gray-200 active:bg-gray-200">
                    <span class="material-symbols-outlined">
                        folder_open
                    </span>
                    <span class="sm:hidden md:inline">Pindah album</span>
                </button>
                <x-modal
                    name="mass-pindah-album-modal"
                    :show="$errors->massPindahAlbum->any()"
                    :closeOnOutsideClick="false">
                    <div class="wrapper mass-pindah-album-modal">
                        <form
                            method="post"
                            action="{{ route("foto.multiplepindahalbum") }}"
                            class="p-6"
                            x-data="{ submitting: false }"
                            @submit.prevent="submitting = true; $el.submit()">
                            @csrf
                            @method("patch")

                            <div class="flex-col gap-4">
                                <div class="text-[20px] font-semibold">
                                    Pindahkan
                                    <span
                                        style="
                                                font-weight: inherit;
                                                font-size: inherit;
                                            "
                                        class="pindahCounter"></span>
                                    foto ke album
                                </div>
                                <div class="mt-2 opacity-70">
                                    Kelompokan momen-momen berharga anda
                                </div>
                            </div>

                            <div class="mt-6" x-data="{ show: false }">
                                <input
                                    type="hidden"
                                    class="id_foto"
                                    name="id_foto" />
                                <label
                                    for="current_password"
                                    class="font-medium after:ml-0.5 after:text-red-500 after:content-['*']">
                                    Album aktif
                                </label>
                                <select
                                    required
                                    id="mass-album-selector"
                                    name="folder_id"
                                    class="select select-md mt-2 w-full">
                                    <option disabled selected>
                                        Pilih album tujuan
                                    </option>
                                </select>
                                @error("folder_id")
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-init="setTimeout(() => (show = false), 5000)">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="mt-4 flex justify-between gap-2">
                                <button
                                    type="button"
                                    @click="show = false; window.dispatchEvent(new CustomEvent('mass-pindah-album-modal'))"
                                    :disabled="submitting"
                                    class="disabled:pointer-none w-full rounded-md px-4 py-3 font-bold transition-all ease-in-out hover:bg-gray-200 disabled:text-gray-500">
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    :disabled="submitting"
                                    class="flex w-full items-center justify-center rounded-md bg-gray-900 px-4 py-3 font-bold text-white transition-all ease-in-out hover:bg-cyan-600">
                                    <template x-if="!submitting">
                                        <span class="text-white">
                                            Pindahkan
                                        </span>
                                    </template>

                                    <template x-if="submitting">
                                        <div role="status">
                                            <svg
                                                aria-hidden="true"
                                                class="h-6 w-6 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
                                                viewBox="0 0 100 101"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                            <span class="sr-only">
                                                Loading...
                                            </span>
                                        </div>
                                    </template>
                                </button>
                            </div>
                        </form>
                    </div>
                </x-modal>
                <button
                    class="massArsipkanBtn flex gap-2 rounded-xl bg-gray-100 p-3 px-4 transition-all ease-in-out hover:bg-gray-200 active:bg-gray-200">
                    <span class="material-symbols-outlined">archive</span>
                    <span class="sm:hidden md:inline">Arsipkan</span>
                </button>
                <x-modal
                    name="mass-arsipkan-modal"
                    :show="$errors->massArsipkan->any()"
                    :closeOnOutsideClick="false">
                    <div class="wrapper mass-arsipkan-modal">
                        <form
                            method="post"
                            action="{{ route("foto.multiplearsip") }}"
                            class="p-6"
                            x-data="{ submitting: false }"
                            @submit.prevent="submitting = true; $el.submit()">
                            @csrf
                            @method("patch")

                            <div class="flex-col gap-4">
                                <div class="text-[20px] font-semibold">
                                    Arsipkan
                                    <span
                                        style="
                                                font-weight: inherit;
                                                font-size: inherit;
                                            "
                                        class="arsipCounter"></span>
                                    foto
                                </div>
                                <div class="mt-2 opacity-70">
                                    Sembunyikan foto pribadi anda
                                </div>
                            </div>

                            <div class="mt-6" x-data="{ show: false }">
                                <input
                                    type="hidden"
                                    class="id_foto"
                                    name="id_foto" />
                                @error("id_foto")
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-init="setTimeout(() => (show = false), 5000)">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="mt-4 flex justify-between gap-2">
                                <button
                                    type="button"
                                    @click="show = false; window.dispatchEvent(new CustomEvent('mass-arsipkan-modal'))"
                                    :disabled="submitting"
                                    class="disabled:pointer-none w-full rounded-md px-4 py-3 font-bold transition-all ease-in-out hover:bg-gray-200 disabled:text-gray-500">
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    :disabled="submitting"
                                    class="flex w-full items-center justify-center rounded-md bg-gray-900 px-4 py-3 font-bold text-white transition-all ease-in-out hover:bg-cyan-600">
                                    <template x-if="!submitting">
                                        <span class="text-white">
                                            Arsipkan
                                        </span>
                                    </template>

                                    <template x-if="submitting">
                                        <div role="status">
                                            <svg
                                                aria-hidden="true"
                                                class="h-6 w-6 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
                                                viewBox="0 0 100 101"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                            <span class="sr-only">
                                                Loading...
                                            </span>
                                        </div>
                                    </template>
                                </button>
                            </div>
                        </form>
                    </div>
                </x-modal>
                <button
                    class="massDeleteBtn flex gap-2 rounded-xl bg-gray-100 p-3 px-4 transition-all ease-in-out hover:bg-gray-200 active:bg-gray-200">
                    <span class="material-symbols-outlined">delete</span>
                    <span class="sm:hidden md:inline">Hapus foto</span>
                </button>
                <x-modal
                    name="mass-delete-modal"
                    :show="$errors->massDelete->any()"
                    :closeOnOutsideClick="false">
                    <div class="wrapper mass-delete-modal">
                        <form
                            method="post"
                            action="{{ route("foto.multipledelete") }}"
                            class="p-6"
                            x-data="{ submitting: false }"
                            @submit.prevent="submitting = true; $el.submit()">
                            @csrf
                            @method("patch")

                            <div class="flex-col gap-4">
                                <div class="text-[20px] font-semibold">
                                    Hapus
                                    <span
                                        style="
                                                font-weight: inherit;
                                                font-size: inherit;
                                            "
                                        class="deleteCounter"></span>
                                    foto
                                </div>
                                <div class="mt-2 opacity-70">
                                    Perhatian! tindakan ini tidak dapat
                                    dikembalikan
                                </div>
                            </div>

                            <div class="mt-6" x-data="{ show: false }">
                                <input
                                    type="hidden"
                                    class="id_foto"
                                    name="id_foto" />
                                @error("id_foto")
                                <p
                                    class="mt-1 text-sm text-red-600"
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-init="setTimeout(() => (show = false), 5000)">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="mt-4 flex justify-between gap-2">
                                <button
                                    type="button"
                                    @click="show = false; window.dispatchEvent(new CustomEvent('mass-delete-modal'))"
                                    :disabled="submitting"
                                    class="disabled:pointer-none w-full rounded-md px-4 py-3 font-bold transition-all ease-in-out hover:bg-gray-200 disabled:text-gray-500">
                                    Batal
                                </button>
                                <button
                                    type="submit"
                                    :disabled="submitting"
                                    class="flex w-full items-center justify-center rounded-md bg-gray-900 px-4 py-3 font-bold text-white transition-all ease-in-out hover:bg-cyan-600">
                                    <template x-if="!submitting">
                                        <span class="text-white">
                                            Hapus foto
                                        </span>
                                    </template>

                                    <template x-if="submitting">
                                        <div role="status">
                                            <svg
                                                aria-hidden="true"
                                                class="h-6 w-6 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
                                                viewBox="0 0 100 101"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                            <span class="sr-only">
                                                Loading...
                                            </span>
                                        </div>
                                    </template>
                                </button>
                            </div>
                        </form>
                    </div>
                </x-modal>
                <button
                    class="selectAllBtn btn-primary flex gap-2 rounded-xl border-[1.5px] border-sky-500 p-3 px-4 transition-all ease-in-out hover:bg-sky-100 focus:bg-sky-100 active:bg-sky-100">
                    <span class="material-symbols-outlined text-sky-500">
                        done_all
                    </span>
                    <span class="text-sky-500 sm:hidden md:inline">
                        Pilih semua
                    </span>
                </button>
            </div>
        </div>
    </div>
    @if ($foto->isEmpty() && ! empty($search))
    <div
        class="flex h-full w-full flex-col items-center justify-center gap-4 overflow-y-auto rounded-t-3xl bg-stone-50 text-black">
        <div class="translate-y-[-15dvh] text-xl font-normal">
            Foto tidak ditemukan
        </div>
        <div>
            <button
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))"
                class="translate-y-[-15dvh] rounded-2xl border border-gray-500 px-6 py-3 text-base font-bold text-black transition hover:bg-cyan-600 hover:text-white">
                Upload foto
            </button>
        </div>
    </div>
    @elseif ($foto->isEmpty() && empty($search))
    <div
        class="flex h-full w-full flex-col items-center justify-center gap-4 rounded-t-3xl bg-stone-50 text-black">
        <div class="translate-y-[-15dvh] text-xl font-normal">
            Belum upload foto
        </div>
        <div>
            <button
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))"
                class="translate-y-[-15dvh] rounded-2xl border border-gray-500 px-6 py-3 text-base font-bold text-black transition hover:bg-cyan-600 hover:text-white">
                Upload foto
            </button>
        </div>
    </div>
    @else
    <div
        class="block h-full w-full overflow-y-auto rounded-t-3xl bg-stone-50 px-6">

        <div class="text-gray-500 text-md text-center font-normal w-full my-3  font-interbg-transparent backdrop-blur-lg">
            Menampilkan <span>{{ $foto->flatten()->count() }}</span> Foto

        </div>

        @foreach ($foto as $tanggal => $groupedPhotos)
        <div class="my-3 flex items-center gap-4">
            <div class="flex-1 border-t border-cyan-600"></div>
            <span
                class="whitespace-nowrap font-bold text-2xl text-black">
                {{ $tanggal }}
            </span>
            <div class="flex-1 border-t border-cyan-600"></div>
        </div>

        <div
            class="foto-group grid max-w-full grid-cols-[repeat(auto-fill,minmax(320px,1fr))] justify-items-start gap-3 md:justify-items-stretch">
            @foreach ($groupedPhotos as $ft)
            <x-photo-tumbnail
                :path="$ft->file_path"
                :title="$ft->photo_title"
                :date="$ft->created_at"
                :photoId="$ft->id_photo"
                :isLoved="$ft->is_favorite">
                <x-daisy-dropdown colorClass="default">
                    <div class="flex-col">
                        <button
                            type="button"
                            class="pindahAlbum flex w-full items-center gap-3 rounded-md px-2 py-2 transition-all ease-in-out hover:bg-gray-100"
                            onclick="document.getElementById('modalPindahAlbum').showModal()">
                            <input
                                type="hidden"
                                class="id_foto"
                                value="{{ $ft->id_photo }}" />
                            <input
                                type="hidden"
                                class="title_foto"
                                value="{{ $ft->photo_title }}" />
                            <input
                                type="hidden"
                                class="album_id"
                                value="{{ $ft->folder }}" />
                            <span
                                class="material-symbols-outlined p-1">
                                folder_open
                            </span>
                            <span>Pindah ke album</span>
                        </button>
                        <button
                            type="button"
                            class="editJudul flex w-full items-center gap-3 rounded-md px-2 py-2 transition-all ease-in-out hover:bg-gray-100"
                            onclick="document.getElementById('modalEdit').showModal()">
                            <input
                                type="hidden"
                                class="title_foto"
                                value="{{ $ft->photo_title }}" />
                            <input
                                type="hidden"
                                class="id_foto"
                                value="{{ Crypt::encryptString($ft->id_photo) }}" />
                            <span
                                class="material-symbols-outlined p-1">
                                edit
                            </span>
                            <span>Ganti judul</span>
                        </button>
                        <button
                            type="button"
                            class="arsipkanFoto flex w-full items-center gap-3 rounded-md px-2 py-2 transition-all ease-in-out hover:bg-gray-100"
                            onclick="document.getElementById('modalArsip').showModal()">
                            <input
                                type="hidden"
                                class="title_foto"
                                value="{{ $ft->photo_title }}" />
                            <input
                                type="hidden"
                                class="jj"
                                value="{{ Crypt::encryptString($ft->id_photo) }}" />
                            <span
                                class="material-symbols-outlined p-1">
                                archive
                            </span>
                            <span>Arsipkan</span>
                        </button>
                        <button
                            type="button"
                            class="deleteFoto flex w-full items-center gap-3 rounded-md px-2 py-2 transition-all ease-in-out hover:bg-gray-100"
                            onclick="document.getElementById('modalDelete').showModal()">
                            <input
                                type="hidden"
                                class="title_foto"
                                value="{{ $ft->photo_title }}" />
                            <input
                                type="hidden"
                                class="jj"
                                value="{{ Crypt::encryptString($ft->id_photo) }}" />
                            <span
                                class="material-symbols-outlined p-1">
                                delete
                            </span>
                            <span>Hapus foto</span>
                        </button>
                    </div>
                </x-daisy-dropdown>
            </x-photo-tumbnail>
            @endforeach
        </div>
        @endforeach
    </div>
    @endif
</div>

@include("photo.modal-edit-foto")
@include("photo.modal-delete-foto")
@include("photo.modal-arsip-foto")

<dialog id="modalPindahAlbum" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">
            Pindah "
            <span id="albumTitle" class="text-lg"></span>
            " ke album
        </h3>
        <p class="">Kelompokan momen terbaik anda</p>
        <div class="modal-action flex-col">
            <form
                method="POST"
                action="{{ route("foto.singlepindahalbum") }}">
                @csrf
                @method("PATCH")
                <input type="hidden" id="albumId" name="id_foto" />
                <label class="" for="album-selector">Pilih album</label>
                <select
                    id="album-selector"
                    name="folder_id"
                    class="select select-md mt-2 w-full">
                    <option disabled selected>Pilih album tujuan</option>
                </select>
                <hr class="mt-4" />
                <button type="submit" class="btn btn-primary mt-4 w-full">
                    Pindahkan
                </button>
            </form>
            <form method="dialog">
                <button class="btn w-full">Batal</button>
            </form>
        </div>
    </div>
</dialog>

{{-- single upload toast --}}
@if (session("status"))
<div
    class="toast toast-center"
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => (show = false), 5000)">
    <div class="alert flex items-center border-none bg-green-300">
        <span>{{ session("message") }}</span>
        <button
            type="button"
            class="flex text-sm text-black hover:text-black"
            @click="show = false">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
</div>
@endif

<x-modal
    name="upload-photo"
    :show="$errors->any()"
    :closeOnOutsideClick="false"
    maxWidth="2xl">
    <div
        class="flex flex-col items-start justify-start gap-4 overflow-y-auto rounded-2xl bg-white px-8 py-8 outline outline-1 outline-offset-[-1px] outline-black/10">
        <!-- Header Section -->
        <div class="flex items-center justify-between gap-5 self-stretch">
            <div
                class="flex flex-1 flex-col items-start justify-start gap-2">
                <h2 class="self-stretch text-xl font-semibold text-black">
                    Upload Foto
                </h2>
                <p class="self-stretch text-base font-normal text-black/70">
                    Simpan momen terbaik anda
                </p>
            </div>
            <button
                type="button"
                @click="$dispatch('close-modal', 'upload-photo')"
                class="flex items-center justify-start gap-2.5 rounded-full bg-zinc-100 p-1.5">
                <span
                    class="material-symbols-outlined text-red-600 hover:text-cyan-600">
                    close
                </span>
            </button>
        </div>

        <!-- Tabs Section -->
        <div
            x-data="{ tab: 'single' }"
            class="flex flex-col gap-6 self-stretch">
            <!-- Tab Switch -->
            <div
                class="flex flex-wrap content-end items-end justify-start self-stretch">
                <div
                    class="flex flex-wrap content-end items-end justify-start gap-7 self-stretch">
                    <div
                        class="flex w-28 cursor-pointer flex-col items-start justify-start gap-2"
                        @click="tab = 'single'">
                        <span
                            :class="tab === 'single' ? 'font-semibold text-cyan-600' : 'font-normal'"
                            class="text-neutral-900 self-stretch text-base">
                            Single upload
                        </span>
                        <div
                            :class="tab === 'single' ? 'bg-cyan-600' : ''"
                            class="h-1.5 self-stretch rounded-tl-[99px] rounded-tr-[99px]"></div>
                    </div>
                    <div
                        class="flex cursor-pointer flex-col items-start justify-start gap-2"
                        @click="tab = 'multi'">
                        <span
                            :class="tab === 'multi' ? 'font-semibold text-cyan-600' : 'font-normal'"
                            class="text-neutral-900 text-base">
                            Multiple upload
                        </span>
                        <div
                            :class="tab === 'multi' ? 'bg-cyan-600' : ''"
                            class="h-1.5 self-stretch rounded-tl-[99px] rounded-tr-[99px]"></div>
                    </div>
                </div>
                <div class="h-[1.5px] w-full bg-cyan-600"></div>
            </div>
            <!-- File Upload Section -->
            <div x-show="tab === 'single'">
                @include("photo.upload")
            </div>

            <div x-show="tab === 'multi'">
                @include("photo.mass_upload")
            </div>
        </div>
    </div>
</x-modal>

<meta name="foto-data" content='@json($foto->flatten())' />
@include("photo.modal-detail-foto")
@endsection
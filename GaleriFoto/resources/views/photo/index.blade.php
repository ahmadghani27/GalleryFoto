@extends('layouts.sidebar')
@section('title', 'Foto')
@section('content')

<div class="flex flex-col gap-2 px-8  bg-gray-100">
    <div class="sticky top-0 z-40 bg-gray-100 px-[5%] py-4">
        <div class="w-full h-16 flex justify-between items-center gap-4">
            <div class="w-full h-16 px-5 bg-white rounded-[999px] outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-between items-center">
                <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input
                        type="text"
                        value="Monyet"
                        class="text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0"
                        placeholder="Cari foto..." />
                </div>
                <span class="material-symbols-outlined">
                    close
                </span>
            </div>
            <div x-data="{ open: false, selected: 'Terbaru' }" class="relative">
                <div
                    @click="open = !open"
                    :class="open ? 'rounded-t-2xl' : 'rounded-2xl'"
                    class="cursor-pointer h-14 px-5 py-5 bg-white  outline outline-1 outline-offset-[-1px] outline-black/10 flex justify-start items-center gap-2">
                    <span class="material-symbols-outlined cursor-pointer">
                        format_line_spacing
                    </span>
                    <div x-text="selected" class="text-neutral-900 text-base font-normal font-inter group-hover:text-white"></div>
                </div>

                <div
                    x-show="open"
                    @click.away="open = false"
                    class="absolute top-full left-0 w-full bg-white rounded-b-2xl outline outline-1 outline-offset-[-1px] outline-black/10 z-10">
                    <div class="flex flex-col">
                        <template x-if="selected === 'Terbaru'">
                            <button
                                @click="selected = 'Terlama'; open = false"
                                class="px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 rounded-b-2xl">
                                Terlama
                            </button>
                        </template>
                        <template x-if="selected === 'Terlama'">
                            <button
                                @click="selected = 'Terbaru'; open = false"
                                class="px-5 py-3 text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 rounded-b-2xl">
                                Terbaru
                            </button>
                        </template>
                    </div>
                </div>
            </div>
            <div class="cursor-pointer p-4 bg-neutral-900 rounded-full flex justify-center items-center gap-2.5 bg-black"
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))">
                <span class="material-symbols-outlined text-white">add</span>
            </div>
        </div>

        <article class="w-full flex justify-between items-center mt-3">
            <div class="text-black text-xl font-normal">Menampilkan 1 Foto "Monyet"</div>
        </article>
    </div>

    <div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-4 justify-items-start max-w-full md:justify-items-stretch ">
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
        <div class="aspect-square rounded-t-md rounded-b-sm  overflow-hidden">
            <img src="{{ asset('sample-photo.jpg') }}" alt="Photo" class="w-full h-full object-cover min-w-[300px] max-w-[450px]">
        </div>
    </div>
</div>
<x-modal name="upload-photo" :show="$errors->has('username')" :closeOnOutsideClick="true" class="max-w-[1080px] w-full" maxWidth="3xl">
    <form action="" method="POST" enctype="multipart/form-data" class="px-8 py-8 bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex flex-col justify-start items-start gap-4 overflow-y-auto">
        @csrf

        <!-- Header Section -->
        <div class="self-stretch flex justify-between items-center gap-5">
            <div class="flex-1 flex flex-col justify-start items-start gap-2">
                <h2 class="self-stretch text-black text-xl font-semibold">Upload Foto</h2>
                <p class="self-stretch text-black/70 text-base font-normal">Simpan momen terbaik anda</p>
            </div>
            <button type="button" @click="$dispatch('close-modal', 'upload-photo')" class="p-1.5 bg-zinc-100 rounded-full flex justify-start items-center gap-2.5">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Tabs Section -->
        <div x-data="{ tab: 'single' }" class="self-stretch flex flex-col gap-6">

            <!-- Tab Switch -->
            <div class="self-stretch flex justify-start items-end flex-wrap content-end">
                <div class="self-stretch flex justify-start items-end gap-7 flex-wrap content-end">
                    <div class="w-28 flex flex-col justify-start items-start gap-2 cursor-pointer" @click="tab = 'single'">
                        <span :class="tab === 'single' ? 'font-semibold' : 'font-normal'" class="self-stretch text-neutral-900 text-base">Single upload</span>
                        <div :class="tab === 'single' ? 'bg-black' : ''" class="self-stretch h-1.5 rounded-tl-[99px] rounded-tr-[99px]"></div>
                    </div>
                    <div class="flex flex-col justify-start items-start gap-2 cursor-pointer" @click="tab = 'multi'">
                        <span :class="tab === 'multi' ? 'font-semibold' : 'font-normal'" class="text-neutral-900 text-base">Multiple upload</span>
                        <div :class="tab === 'multi' ? 'bg-black' : ''" class="self-stretch h-1.5 rounded-tl-[99px] rounded-tr-[99px]"></div>
                    </div>
                </div>
                <div class="w-full h-[1.5px] bg-zinc-300"></div>
            </div>
            <!-- File Input -->
            <div class="self-stretch flex flex-col justify-start items-start gap-3">
                <label class="self-stretch text-black text-base font-medium">Foto anda*</label>
                <div class="self-stretch p-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/5 flex justify-between items-center">
                    <div class="w-72 flex flex-col justify-start items-start gap-3">
                        <div class="self-stretch flex justify-start items-center gap-3">
                            <span class="material-symbols-outlined">shift_lock</span>
                            <span class="text-black text-base font-normal">Drag and drop files here or upload</span>
                        </div>
                        <p class="self-stretch text-black/70 text-sm font-normal">Tipe file yang diterima: jpg, jpeg, png</p>
                    </div>
                    <label class="w-48 h-14 px-2.5 py-5 rounded-2xl outline outline-[1.5px] outline-offset-[-1.5px] hover:text-white hover:bg-black outline-neutral-900 flex justify-center items-center gap-2.5 cursor-pointer transition-all duration-100 hover:bg-neutral-900 hover:text-white">
                        <span class="text-neutral-900 text-base font-bold hover:text-white w-48 h-14 flex justify-center items-center">Upload</span>
                        <input type="file" name="photo" id="photo-upload" accept=".jpg,.jpeg,.png" class="hidden" @change="handleFileUpload">
                    </label>
                </div>
                @error('photo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- File Upload Section -->
            <div x-show="tab === 'single'">
                @include('photo.upload')
            </div>

            <div x-show="tab === 'multi'">
                @include('photo.mass_upload')
            </div>

        </div>
        <!-- Info -->
        <div class="self-stretch">
            <span class="text-black/50 text-base font-normal">*Foto akan disimpan di </span>
            <span class="text-black/50 text-base font-semibold">global</span>
        </div>
        <!-- Submit Button -->
        <div class="self-stretch flex justify-start items-start gap-2">
            <button type="submit" class="flex-1 h-14 px-2.5 py-5 bg-neutral-900 rounded-2xl flex justify-center items-center gap-2.5 transition-all duration-100 bg-black hover:bg-white hover:text-neutral-900 hover:outline hover:outline-[1.5px] hover:outline-neutral-900">
                <span class="text-white flex-1 h-14 flex justify-center items-center text-base font-bold hover:text-black">Upload</span>
            </button>
        </div>
    </form>

    <!-- JavaScript for File Upload and Preview -->
    <script>
        function handleFileUpload(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Clear previous previews

            Array.from(files).forEach(file => {
                if (['image/jpeg', 'image/png'].includes(file.type)) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = new Image();
                        img.onload = function() {
                            const container = document.createElement('div');
                            container.className = 'flex justify-center items-center h-full';

                            const imgElement = document.createElement('img');
                            imgElement.src = e.target.result;

                            // Check if image is landscape (width > height)
                            if (this.width > this.height) {
                                imgElement.className = 'max-h-40 w-auto';
                            } else {
                                imgElement.className = 'h-auto max-w-40';
                            }

                            container.appendChild(imgElement);
                            previewContainer.appendChild(container);
                        };
                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Drag and Drop Functionality
        const dropZone = document.querySelector('.p-5.rounded-2xl');
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-gray-200');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-gray-200');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-gray-200');
            const files = e.dataTransfer.files;
            const input = document.getElementById('photo-upload');
            input.files = files;
            handleFileUpload({
                target: {
                    files
                }
            });
        });
    </script>
</x-modal>

@endsection
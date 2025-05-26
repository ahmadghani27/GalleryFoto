 <!-- File Input -->
<form action="{{ route('foto.singleupload') }}" method="POST" enctype="multipart/form-data" x-data="{ submitting : false }" @submit.prevent="submitting = true; $el.submit()">
    @csrf
    <div class="self-stretch flex flex-col justify-start items-start gap-3">
        <label class="self-stretch text-black text-base font-medium">Foto anda*</label>
        <div class="drop-zone self-stretch p-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/5 flex justify-between items-center">
            <div class="w-72 flex flex-col justify-start items-start gap-3">
                <div class="self-stretch flex justify-start items-center gap-3">
                    <span class="material-symbols-outlined">shift_lock</span>
                    <span class="text-black text-base font-normal">Drag and drop files here or upload</span>
                </div>
                <p class="self-stretch text-black/70 text-sm font-normal">Tipe file yang diterima: jpg, jpeg, png</p>
            </div>
            <label class="w-48 h-14 px-2.5 py-5 rounded-2xl outline outline-[1.5px] outline-offset-[-1.5px]  hover:bg-black outline-neutral-900 flex justify-center items-center gap-2.5 cursor-pointer transition-all duration-100 hover:bg-neutral-900 hover:text-white">
                <span class="text-neutral-900 text-base font-bold hover:text-white w-48 h-14 flex justify-center items-center">Upload</span>
                <input type="file" name="photo" id="photo-upload" accept=".jpg,.jpeg,.png" class="hidden" @change="handleFileUpload">
            </label>
        </div>
        @error('photo')
        <span class="text-red-500 text-sm" x-data="{ show: true }" x-show="show"  x-init="setTimeout(() => show = false, 5000)">{{ $message }}</span>
        @enderror
    </div>

    <div class="self-stretch flex flex-col justify-start items-start gap-6">

        <!-- Preview Section -->
        <div class="self-stretch flex flex-col justify-start items-start gap-3">
            <label class="self-stretch text-black text-base font-medium">Preview foto</label>
            <div class="self-stretch bg-zinc-100 rounded-2xl relative flex items-center justify-center overflow-hidden">
                <div id="preview-container" class="w-full flex justify-center items-center h-40"></div>
                <div class="absolute w-40 h-40 border-2 border-dashed border-black/50 rounded-lg pointer-events-none"></div>
            </div>
        </div>

        <!-- Title Input -->
        <div class="self-stretch flex flex-col justify-start items-start gap-3">
            <label class="self-stretch text-black text-base font-medium">Judul Foto*</label>
            <div class="self-stretch h-14 px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 flex items-center gap-4">
                <span class="material-symbols-outlined">match_case</span>
                <input type="text" name="title" class="w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0 placeholder:text-black/50" placeholder="Masukkan judul foto disini" value="{{ old('title') }}">
            </div>
            @error('title')
            <span class="text-red-500 text-sm" x-data="{ show: true }" x-show="show"  x-init="setTimeout(() => show = false, 5000)">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <!-- Info -->
    <div class="self-stretch mt-2">
        <span class="text-black/50 text-base font-normal">*Foto akan disimpan di </span>
        <span class="text-black/50 text-base font-semibold">global</span>
    </div>
    <!-- Submit Button -->
    <div class="self-stretch flex justify-start items-start mt-2">
        <button type="submit" class="flex-1 h-14 px-2.5 py-5 bg-neutral-900 rounded-2xl flex justify-center items-center gap-2.5 transition-all duration-100 bg-black hover:bg-white hover:text-neutral-900 hover:outline hover:outline-[1.5px] hover:outline-neutral-900">
            <template x-if="!submitting">
               <span class="text-white flex-1 h-14 flex justify-center items-center text-base font-bold hover:text-black">Upload</span>
           </template>
           
           <template x-if="submitting">
               
               <div role="status">
                   <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                       <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                   </svg>
                   <span class="sr-only">Loading...</span>
               </div>
   
           </template>
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
    const dropZone = document.querySelector('.drop-zone');
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
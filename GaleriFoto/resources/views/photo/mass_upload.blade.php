<div x-data="uploadHandler()" x-init>
    <form action="{{ route('foto.multiupload') }}" method="POST" enctype="multipart/form-data" @submit.prevent="submitForm()">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="self-stretch flex flex-col justify-start items-start gap-3">
        <label class="self-stretch text-black text-base font-medium">Foto anda*</label>
        <div class="drop-zone self-stretch p-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/5 flex justify-between items-center"
            
            :class="{ 'bg-gray-200': isDragging }"
            @dragover.prevent="isDragging = true"
            @dragleave="isDragging = false"
            @drop="handleDrop"
        >
            <div class="w-72 flex flex-col justify-start items-start gap-3">
                <div class="self-stretch flex justify-start items-center gap-3">
                    <span class="material-symbols-outlined">shift_lock</span>
                    <span class="text-black text-base font-normal">Drag and drop files here or upload</span>
                </div>
                <p class="self-stretch text-black/70 text-sm font-normal">Tipe file yang diterima: jpg, jpeg, png</p>
            </div>
            <label class="w-48 h-14 px-2.5 py-5 rounded-2xl outline outline-[1.5px] outline-offset-[-1.5px] hover:text-white hover:bg-black outline-neutral-900 flex justify-center items-center gap-2.5 cursor-pointer transition-all duration-100 hover:bg-neutral-900 hover:text-white">
                <span class="text-neutral-900 text-base font-bold hover:text-white w-48 h-14 flex justify-center items-center">Upload</span>
                <input type="file" x-ref="input" accept="image/png, image/jpeg, image/jpg" multiple name="foto" id="photo-upload" accept=".jpg,.jpeg,.png" class="hidden" @change="handleFiles">
            </label>
        </div>
    </div>
    
    <div class="self-stretch flex flex-col justify-start items-start gap-4">
        {{-- <template x-if="totalfile() > 0"> --}}
            <div id="info-file" x-show="totalfile() > 0" x-transition class="mt-3 self-stretch justify-start text-black text-base font-normal">
                <span id="total-foto" x-text="totalfile()"></span>
                <span>foto siap upload (anda dapat mengubah judul foto dengan klik nama file)</span>
            </div>
        {{-- </template> --}}
        <template x-for="(file, index) in files" :key="index">
            <div x-transition class="self-stretch flex flex-col justify-start items-start overflow-hidden">
                <div @click="togglePreview(index)" class="cursor-pointer self-stretch px-5 py-3.5 bg-zinc-100 inline-flex justify-between items-center" :class="{'rounded-lg': activeIndex !== index, 'rounded-t-lg': activeIndex === index}">
                    <div class="flex justify-start items-center gap-3">
                        <span class="material-symbols-outlined">
                            image
                        </span>
                        <div class="flex justify-center items-center gap-6">
                            <input class="bg-transparent flex w-fit border-0 transition-all ease-in-out" type="text" x-model="file.nama" name="title[]" @blur="if (!file.nama.trim()) file.nama = file.file.name">
                            <div class="justify-start text-black text-base font-medium " x-text="formatSize(file.size)"></div>
                        </div>
                    </div>
                    <button type="button" @click="files.splice(index, 1)" class="flex p-1.5 rounded-full flex justify-start items-center gap-2.5">
                        <span class="material-symbols-outlined">
                            close
                        </span>
                    </button>
                </div>
                <div x-show="activeIndex === index" x-transition.scale.origin.top class="self-stretch bg-zinc-100 rounded-b-lg relative flex items-center justify-center overflow-hidden">
                    <div class="w-full flex justify-center items-center h-40">
                        <div class="flex justify-center items-center h-full">
                            <img :src="URL.createObjectURL(file.file)" :class="file.width > file.height ? 'max-h-40 w-auto' : 'h-auto max-w-40'" />
                        </div> 
                    </div>
                    <div class="absolute w-40 h-40 border-2 border-dashed border-black/50 rounded-lg pointer-events-none"></div>
                </div>
            </div>
        </template>
    </div>
    <p class="texxt-sm text-red-500 mt-3" x-text="emptyDataError"></p>
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
</div>
<script>
    function uploadHandler() {
        return {
            files: [],
            activeIndex: null,
            isDragging: false,
            emptyDataError: "",
            submitting: false,
            totalfile() {
                return this.files.length;
            },
            handleFiles(event) {
                const selectedFiles = Array.from(event.target.files);

                for (const file of selectedFiles) {
                    if (/\.(jpg|jpeg|png)$/i.test(file.name)) {
                        this.files.push({
                            file,
                            nama: file.name,
                            size: file.size,
                            width: file.width,
                            height: file.height
                        });
                    }
                }

                event.target.value = null;
            },
            formatSize(bytes) {
                if (bytes === 0) return '0 B';
                const sizes = ['B', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(1024));
                return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
            },
            togglePreview(index) {
                this.activeIndex = this.activeIndex === index ? null : index;
            },
            handleDrop(e) {
                e.preventDefault();
                this.isDragging = false;
                const files = e.dataTransfer.files;
                this.handleFiles({ target: { files } });
            },
            async submitForm() {
                if (!this.files.length || this.files.some(f => !f.file)) {
                    this.emptyDataError = "Data kosong";
                    return;
                }

                this.submitting = true;
                const formData = new FormData();

                this.files.forEach((fileObj, index) => {
                    formData.append('photo[]', fileObj.file);
                    formData.append('title[]', fileObj.nama);
                });

                try {
                    const response = await fetch("{{ route('foto.multiupload') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    const data = await response.json();
                     if (!response.ok) {
                        // Server kirim error (misalnya validation error dari Laravel)
                        throw data;
                    }
                    console.log("Result:", data);
                    this.files = [];

                    if(response.ok) {
                        window.location.href = data.redirect;
                    }
                } catch (error) {
                    if (error.errors) {
                        // Laravel validation error
                        console.error("Validation Errors:", error.errors);
                        this.emptyDataError = "Data tidak memenuhi syarat"
                    } else {
                        console.error("Unexpected Error:", error);
                    }
                } finally {
                    this.submitting = false;
                }
            }
        };
    }
    
</script>

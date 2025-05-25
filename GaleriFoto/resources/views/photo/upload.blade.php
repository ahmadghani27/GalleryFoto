<div class="self-stretch flex flex-col justify-start items-start gap-6">

    <!-- Preview Section -->
    <div class="self-stretch flex flex-col justify-start items-start gap-3">
        <label class="self-stretch text-black text-base font-medium">Preview foto</label>
        <div class="self-stretch bg-zinc-100 rounded-2xl relative flex items-center justify-center overflow-hidden">
            <div id="preview-container" class="w-full h-full flex justify-center items-center"></div>
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
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

</div>

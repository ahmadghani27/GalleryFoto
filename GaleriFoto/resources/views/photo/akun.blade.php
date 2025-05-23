@extends('layouts.sidebar')

@section('title', 'Akun')

@section('content')
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Informasi Akun</h1>
        @if (session('status'))
        <div class="toast toast-center" x-data="{ show: true }" x-show="show"  x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center alert bg-green-300 border-none">
                <span>{{ session('status') }}</span>
                <button type="button" class="flex text-sm hover:text-black text-gray-800" @click="show = false">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>
        @endif
        <div class="flex p-6 bg-white gap-8 flex-wrap rounded-md justify-between items-center">
            <div class="flex gap-8">
                <div class="flex-col">
                    <div class="text-[16px] opacity-50">Username</div>
                    <div class="text-[20px] font-medium">{{  $user->username }}</div>
                </div>
                <div>
                    <div class="text-[16px] opacity-50">Bergabung pada</div>
                    <div class="text-[20px] font-medium">{{ $user->created_at->translatedFormat('d F Y') }}</div>
                </div>
            </div>
            <div class="flex gap-8">
                <button type="button" class="flex items-center gap-4 p-4 bg-white border-2 border-black rounded-md" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-username' }))">
                    <span class="material-symbols-outlined">edit</span>
                    <span class="">Ganti username</span>
                </button>
                <button type="button" class="flex items-center gap-4 p-4 bg-black rounded-md" onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'reset-password' }))">
                    <span class="material-symbols-outlined text-white">cached</span>
                    <span class="text-white">Reset password</span>
                </button>
                
            </div>
        </div>

        <h1 class="text-2xl font-bold mt-8 mb-4">Hapus Akun</h1>
        <p class="text-gray-600 text-md">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, silakan unduh data atau informasi apa pun yang ingin Anda simpan
        </p>

        <button type="button" class="bg-red-600 px-6 py-3 rounded-md mt-4 text-white font-semibold text-sm"
                onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'confirm-user-deletion' }))"
        > HAPUS AKUN</button>
    </div>
    
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6"
            x-data="{ submitting: false }"
            @submit.prevent="submitting = true; $el.submit()"
        >
            @csrf
            @method('delete')

            <div class="flex-col gap-4">
                <div class="text-[20px] font-semibold">Yakin menghapus akun anda?</div>
                <div class="mt-2 opacity-70">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen</div>
            </div>

            <div class="mt-6"  x-data="{show: false}">
                <label for="current_password" class="font-medium after:ml-0.5 after:text-red-500 after:content-['*']">Konfirmasi kata sandi</label>
                <div class="mt-3 flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username">
                    <div class="grid place-center">
                        <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">key_vertical</span>
                    </div>
    
                    <input :type="show? 'text' : 'password'" name="password" id="password"
                    class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                            border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600" placeholder="Masukkan kata sandi">
    
                    <button type="button" class="grid place-center" @click="show = !show">
                        <template x-if="show">
                            <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility_off</span>
                        </template>
                        <template x-if="!show">
                            <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility</span>
                        </template>
                    </button>
                </div>
                
                @foreach ($errors->userDeletion->get('password') as $message)
                        <p class="text-red-500 text-sm mt-2" x-data="{ show: true }" x-show="show"  x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
                @endforeach 
            </div>
            <div class="flex justify-between gap-2 mt-4">
                <button type="button" @click="show = false; window.dispatchEvent(new CustomEvent('reset-newusername'))" :disabled="submitting"
                    class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">Batal</button>
                <button type="submit" :disabled="submitting"
                    class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                        <template x-if="!submitting">
                        <span class="text-white">Hapus akun</span>
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
    </x-modal>


    {{-- modal ganti username --}}
    <x-modal name="edit-username" 
    maxWidth="sm"
    :show="$errors->has('username')"
    :closeOnOutsideClick="false">
        <div class="p-6">
            <div class="flex-col gap-4">
                <div class="text-[20px] font-semibold">Ganti username</div>
                <div class="opacity-70">Ini tanda pengenal anda, harus unik!</div>
            </div>
            
            <form action="{{ route('profile.update') }}" method="POST"
                x-data="{ submitting: false }"
                @submit.prevent="submitting = true; $el.submit()"
            >
                @csrf
                @method('PATCH')
                <div class="flex-col mt-6 items-center justify-items-center">
                    <div class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username">
                        
                        <div class="grid place-center">
                            <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">match_case</span>
                        </div>
        
                        <input type="text"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                                border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600"
                        value="{{ $user->username }}" disabled>
        
                    </div>
                    <span class="material-symbols-outlined mt-4 mb-4 shrink-0 text-2 text-gray-500 select-none">swap_vert</span>
                    <div x-data="{ username: '{{ $errors->has('username') ? old('username', $user->username) : '' }}' }" class="flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username"
                        x-init="
                        window.addEventListener('reset-newusername', () => {
                            username = '';
                        });
                        "
                        >
                        
                        <div class="grid place-center">
                            <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">match_case</span>
                        </div>
        
                        <input type="text" name="username" id="username" autocomplete="off"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 
                                border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600"
                        placeholder="Masukkan username baru" required x-model="username"> 
                    </div>
                    @error('username')
                        <p class="text-red-600 text-sm mt-1 " x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-between gap-2 mt-4">
                    <button type="button" @click="show = false; window.dispatchEvent(new CustomEvent('reset-newusername'))" :disabled="submitting"
                        class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">Batal</button>
                    <button type="submit" :disabled="submitting"
                        class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                         <template x-if="!submitting">
                            <span class="text-white">Simpan</span>
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
    </x-modal>
    {{-- end modal ganti username --}}

    <x-modal 
    name="reset-password"
    maxWidth="md"
    :show="$errors->updatePassword->any()"
    :closeOnOutsideClick="false">
    
    <div class="p-6">
        <div class="flex-col gap-4">
            <div class="text-[20px] font-semibold">Update kata sandi</div>
            <div class="opacity-70">Segarkan kata sandi anda</div>
        </div>
        <form action="{{ route('update_password') }}" method="POST"
            x-data="{ submitting: false }"
            @submit.prevent="submitting = true; $el.submit()"
        >
            @csrf
            @method('PATCH')

            <div class="flex-col mt-6">
                <div class="flex-col mb-6" x-data="{show: false}">
                    <label for="current_password" class="font-medium after:ml-0.5 after:text-red-500 after:content-['*']">Kata sandi saat ini</label>
                    <div class="mt-3 flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username">
                        <div class="grid place-center">
                            <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">key_vertical</span>
                        </div>
        
                        <input :type="show? 'text' : 'password'" name="current_password"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                                border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600" placeholder="Masukkan kata sandi saat ini">
        
                        <button type="button" class="grid place-center" @click="show = !show">
                            <template x-if="show">
                                <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility_off</span>
                            </template>
                            <template x-if="!show">
                                <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility</span>
                            </template>
                        </button>
                    </div>
                    @foreach ($errors->updatePassword->get('current_password') as $message)
                        <p class="text-red-500 text-sm mt-2" x-data="{ show: true }" x-show="show"  x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
                    @endforeach                        
                </div>
                <div class="flex-col mb-6" x-data="{show: false}">
                    <label for="password" class="font-medium after:ml-0.5 after:text-red-500 after:content-['*']">Kata sandi baru</label>
                    <div class="mt-3 flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username">
                        <div class="grid place-center">
                            <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">key_vertical</span>
                        </div>
        
                        <input :type="show? 'text' : 'password'" name="password"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                                border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600" placeholder="Masukkan kata sandi baru">
        
                        <button type="button" class="grid place-center" @click="show = !show">
                            <template x-if="show">
                                <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility_off</span>
                            </template>
                            <template x-if="!show">
                                <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility</span>
                            </template>
                        </button>
                    </div>
                    @foreach ($errors->updatePassword->get('password') as $message)
                        <p class="text-red-500 text-sm mt-2" x-data="{ show: true }" x-show="show"  x-init="setTimeout(() => show = false, 5000)">{{ $message }}</p>
                    @endforeach
                </div>
                <div class="flex-col mb-6" x-data="{show: false}">
                    <label for="password_confirmation" class="font-medium after:ml-0.5 after:text-red-500 after:content-['*']">Konfirmasi kata sandi baru</label>
                    <div class="mt-3 flex items-center gap-2 rounded-md bg-white px-4 py-2 border-gray-300 border-2 w-full outline outline-1 outline-transparent focus-within:outline-2 focus-within:outline-indigo-300 wrapper-old-username">
                        <div class="grid place-center">
                            <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">key_vertical</span>
                        </div>
        
                        <input :type="show? 'text' : 'password'" name="password_confirmation"
                        class="block bg-transparent min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400
                                border-none focus:outline-none focus:ring-0 focus:border-none shadow-none disabled:text-gray-600" placeholder="Konfirmasi kata sandi baru">
        
                        <button type="button" class="grid place-center" @click="show = !show">
                            <template x-if="show">
                                <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility_off</span>
                            </template>
                            <template x-if="!show">
                                <span class="material-symbols-outlined shrink-0 text-2 text-gray-900 select-none">visibility</span>
                            </template>
                        </button>
                    </div>
                </div>
                <div class="flex justify-between gap-2 mt-4">
                    <button type="button" @click="show = false; window.dispatchEvent(new CustomEvent('reset-newusername'))" :disabled="submitting"
                        class="disabled:text-gray-500 disabled:pointer-none font-bold px-4 w-full py-3 rounded-md hover:bg-gray-200 transition-all ease-in-out">Batal</button>
                    <button type="submit" :disabled="submitting"
                        class="flex items-center justify-center font-bold px-4 w-full py-3 bg-gray-900 text-white rounded-md hover:bg-black transition-all ease-in-out">
                            <template x-if="!submitting">
                            <span class="text-white">Update</span>
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
            </div>
        </form>
    </div>


    </x-modal>
    
@endsection
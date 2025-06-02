@extends('layouts.sidebar')
@section('title', 'Arsip')

@section('content')

<div x-data="{
    password: '',
    showPassword: false,
    errorMessage: '',
    isLoading: false,
    
    async checkPassword() {
        this.isLoading = true;
        this.errorMessage = '';
        
        try {
            const response = await fetch('{{ route('arsip.verify') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    password: this.password
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                this.errorMessage = data.message || 'Kata sandi salah';
            }
        } catch (error) {
            this.errorMessage = 'Terjadi kesalahan, silakan coba lagi';
        } finally {
            this.isLoading = false;
        }
    }
}">
    <div class="flex items-center justify-center w-full min-h-screen bg-stone-50 p-4">
        <div class="flex flex-col justify-center items-center gap-6 max-w-md w-full bg-white p-8 rounded-2xl shadow-sm">
            <!-- Header Section -->
            <div class="w-full flex flex-col justify-start items-start gap-4">
                <h1 class="text-2xl font-bold text-neutral-900">Masukkan kata sandi akun anda</h1>
                <p class="text-base font-normal text-neutral-900/70">Masukkan kata sandi untuk mengakses arsip</p>
                <div class="w-full h-px bg-black/10"></div>
            </div>

            <!-- Error Message -->
            <div x-show="errorMessage" x-text="errorMessage" class="w-full text-red-500 text-sm"></div>

            <!-- Password Input Section -->
            <div class="w-full flex flex-col gap-3">
                <label for="password" class="text-base font-medium text-neutral-900">Kata sandi</label>
                <div class="relative border border-yellow-500 rounded-2xl">
                    <input
                        x-model="password"
                        :type="showPassword ? 'text' : 'password'"
                        id="password"
                        name="password"
                        required
                        @keyup.enter="checkPassword"
                        class="w-full px-5 py-5 rounded-2xl text-black/80 placeholder-black/50"
                        placeholder="Masukkan kata sandi">
                </div>
            </div>

            <!-- Submit Button -->
            <button
                @click="checkPassword"
                :disabled="isLoading"
                class="w-full px-6 py-4 bg-neutral-900 hover:bg-neutral-800 rounded-2xl transition-colors duration-200 disabled:opacity-50 bg-cyan-600">
                <span x-show="!isLoading" class="text-white text-base font-bold ">Masuk</span>
                <span x-show="isLoading" class="text-white text-base font-bold">Memverifikasi...</span>
            </button>
        </div>
    </div>
</div>

@endsection
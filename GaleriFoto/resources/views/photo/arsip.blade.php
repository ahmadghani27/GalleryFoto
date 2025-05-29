@extends('layouts.sidebar')
@section('title', 'Arsip')

@section('content')

<!-- 

-->
<!-- resources/views/photo/arsip.blade.php -->
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
    <div class="flex items-center justify-center w-full min-h-screen bg-gray-200 p-4">
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
                <div class="relative">
                    <input
                        x-model="password"
                        :type="showPassword ? 'text' : 'password'"
                        id="password"
                        name="password"
                        required
                        @keyup.enter="checkPassword"
                        class="w-full px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 text-black/80 placeholder-black/50"
                        placeholder="Masukkan kata sandi">
                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-neutral-500 hover:text-neutral-700">
                        <span x-text="showPassword ? 'visibility_off' : 'visibility'" class="material-symbols-outlined"></span>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button
                @click="checkPassword"
                :disabled="isLoading"
                class="w-full px-6 py-4 bg-neutral-900 hover:bg-neutral-800 rounded-2xl transition-colors duration-200 disabled:opacity-50">
                <span x-show="!isLoading" class="text-white text-base font-bold">Masuk</span>
                <span x-show="isLoading" class="text-white text-base font-bold">Memverifikasi...</span>
            </button>
        </div>
    </div>
</div>

<!-- Arsip Content -->
<template x-if="isAuthenticated">
    <div class="flex flex-col bg-white">
        <!-- Header/Navbar -->
        <div class="flex flex-col bg-white">
            <div class="sticky top-0 z-40 px-6 py-3 pt-6 bg-white border-b-[1.5px] border-gray-200">
                <div class="flex gap-5">
                    <div class="flex-1 py-1 px-5 bg-white rounded-full border-[1.5px] border-gray-300 flex justify-between items-center">
                        <div class="flex justify-start items-center gap-4 w-full mr-3.5">
                            <span class="material-symbols-outlined">
                                search
                            </span>
                            <input
                                type="search"
                                value="Monyet"
                                class="text-neutral-900 text-base font-normal font-inter w-full border-none outline-none bg-transparent focus:outline-none focus:ring-0"
                                placeholder="Cari foto..." />
                        </div>
                    </div>
                    <button type="button" class="cursor-pointer p-3 !bg-black rounded-full flex items-center gap-2 pr-4"
                        onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'upload-photo' }))">
                        <span class="material-symbols-outlined text-gray-300">
                            add
                        </span>
                        <span class="text-gray-300 font-semibold">Tambah Foto</span>
                    </button>
                </div>
                <div class="w-full flex items-center mt-3 gap-6">
                    <div class="flex justify-end items-center gap-5">
                        <div x-data="{ open: false, selected: new URLSearchParams(window.location.search).get('sort') === 'asc' ? 'Terlama' : 'Terbaru' }" class="relative">
                            <div
                                @click="open = !open" :class="{'rounded-t-md': open, 'rounded-full': !open}"
                                class="cursor-pointer px-5 py-3 !bg-white border-[1.5px] border-gray-300 rounded-full flex justify-start items-center gap-2
                        ">
                                <span class="material-symbols-outlined cursor-pointer">
                                    format_line_spacing
                                </span>
                                <div x-text="selected" class="text-neutral-900 text-base font-normal font-inter group-hover:text-white"></div>
                            </div>

                            <div
                                x-show="open"
                                @click.away="open = false"
                                class="absolute top-full left-0 w-full bg-transparent">
                                <div class="flex flex-col">
                                    <template x-if="selected === 'Terbaru'">
                                        <a
                                            href="{{ route('foto', ['sort' => 'asc']) }}"
                                            @click="selected = 'Terlama'; open = false"
                                            class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] ">
                                            Terlama
                                        </a>
                                    </template>
                                    <template x-if="selected === 'Terlama'">
                                        <a
                                            href="{{ route('foto', ['sort' => 'desc']) }}"
                                            @click="selected = 'Terbaru'; open = false"
                                            class="px-5 py-2 bg-white text-neutral-900 text-base font-normal font-inter hover:bg-black hover:text-white transition-colors duration-200 bg-white rounded-b-md border-[1.5px] ">
                                            Terbaru
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" text-gray-500 text-md font-normal font-inter bg-white/80 backdrop-blur-lg">Menampilkan Foto
                    </div>
                </div>
            </div>
            <div class="block px-6 bg-gray-100">

            </div>
        </div>

        <!-- Content Area -->
        <div class="block px-6 bg-gray-100">
            @include('photo.arsip-content') <!-- Buat partial view untuk konten arsip -->
        </div>
    </div>
</template>
</div>
@endsection
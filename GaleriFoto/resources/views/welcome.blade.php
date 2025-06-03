<!DOCTYPE html>
<html lang="en" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pixelora - Your Digital Gallery</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon">

    <!-- Font and icon imports -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Smooth fade-in animation for page load */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
</head>

<body class="antialiased font-inter bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Main container with fade-in animation -->
    <div class="animate-fade-in">
        <!-- Header section with logo -->
        <header class="w-full py-8 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <!-- Logo with hover effect -->
                <div class="flex items-center space-x-2 transition-transform duration-300 hover:scale-105">
                    <img src="{{ asset('assets/img/Pixelora.png') }}" alt="Pixelora Logo" class="h-12 w-auto">
                </div>
            </div>
        </header>
        <!-- Hero section -->
        <main class="flex flex-col items-center justify-center px-4 py-12 sm:py-24">
            <!-- Tagline -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-center text-gray-800 mb-6">
                Pamerkan Cerita <span class="text-cyan-600"> Visual Anda </span>
            </h1>
            
            <p class="text-lg sm:text-xl text-gray-600 text-center max-w-2xl mb-12">
                Platform galeri digital <span class="text-yellow-500 font-semibold"> PIXELORA </span> untuk mengatur dan mengabadikan momen berharga Anda.
            </p>

            <!-- Action buttons container -->
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                <!-- Login button -->
                <a href="/login" 
                   class="px-8 py-3 bg-cyan-600 hover:bg-cyan-700 text-white font-medium rounded-lg text-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">login</span>
                    Masuk
                </a>
                
                <!-- Register button -->
                <a href="/register" 
                   class="px-8 py-3 bg-white hover:bg-gray-50 text-cyan-600 border border-cyan-600 font-medium rounded-lg text-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">person_add</span>
                    Daftar
                </a>
            </div>
        </main>

        <!-- Feature highlights (optional section) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="text-cyan-600 mb-4">
                    <span class="material-symbols-outlined text-4xl">photo_library</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Atur dengan Mudah </h3>
                <p class="text-gray-600">Buat album dan kategorikan foto Anda dengan mudah.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="text-cyan-600 mb-4">
                    <span class="material-symbols-outlined text-4xl">favorite</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Simpan Favorit</h3>
                <p class="text-gray-600">Tandai foto terbaik untuk akses cepat kapan saja.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="text-cyan-600 mb-4">
                    <span class="material-symbols-outlined text-4xl">lock</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Arsip Pribadi </h3>
                <p class="text-gray-600">Simpan kenangan pribadi dengan aman dalam koleksi privat.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="w-full py-8 px-4 border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto text-center text-gray-500 text-sm">
                &copy; {{ now()->year }} Pixelora. Semua hak dilindungi.
            </div>
        </footer>
    </div>
</body>
</html>
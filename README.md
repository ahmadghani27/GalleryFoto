📸 Galeri Foto

Selamat datang di Galeri Foto, aplikasi web kece berbasis Laravel untuk mengatur dan memamerkan koleksi foto kamu dengan gampang! 🚀 Upload, kelola, dan arsipkan foto dengan tampilan yang ciamik, fitur canggih, dan pengalaman pengguna yang super nyaman. 😎

🌟 Apa Itu Galeri Foto?

Galeri Foto adalah aplikasi web untuk menyimpan dan menampilkan foto dengan judul dan URL yang tersimpan rapi di database. Dibuat dengan teknologi modern, aplikasi ini bikin kamu bisa kelola foto dengan gaya! 💻✨

Menggunakan Laravel untuk backend, XAMPP untuk database MySQL, Laravel Breeze untuk autentikasi, Blade Components untuk antarmuka rapi, dan Alpine.js untuk interaktivitas ringan. Desainnya responsif banget berkat Tailwind CSS, jadi kece di semua perangkat! 📱💻

🎉 Fitur Unggulan

## 🎉 Fitur Unggulan

| 📤 **Upload Foto** | 📁 **Manajemen Folder** | 🔍 **Pencarian Cepat** |
|---------------------|-------------------------|-----------------------|
| Unggah satu atau banyak foto sekaligus, judul otomatis dari nama file. | Buat, edit, hapus folder, dan pindahkan foto secara massal. | Cari foto berdasarkan judul atau nama folder dengan hasil instan. |

| 🔒 **Arsip Aman** | ✅ **Operasi Massal** | ⭐ **Favorit** |
|-------------------|-----------------------|---------------|
| Lindungi foto dengan kata sandi untuk privasi ekstra. | Hapus atau pindahkan banyak foto dengan checkbox dan tombol batal. | Tandai foto favorit untuk akses cepat. |

| 🔄 **Urutkan Foto** | 👤 **Akun Pengguna** | 📊 **Detail Foto** |
|---------------------|---------------------|-------------------|
| Urutkan foto berdasarkan tanggal (terbaru/terlama). | Login dan register dengan aman via **Laravel Breeze**. | Lihat info seperti nama, tanggal upload, dan ukuran file. |

---

🛠️ Teknologi yang Digunakan

<img src="https://laravel.com/img/logomark.min.svg" width="60" alt="Laravel Logo"> 
<img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" width="60" alt="MySQL Logo"> 
<img src="https://laravel.com/img/logomark.min.svg" width="60" alt="Laravel Breeze Logo"> 
<img src="https://laravel.com/img/logomark.min.svg" width="60" alt="Blade Logo"> 
<img src="https://tailwindcss.com/_next/static/media/tailwindcss-mark.3c5441fc7a190fb1800d4a5c7f07ba4b1345a9c8.svg" width="60" alt="Tailwind CSS Logo"> 
<img src="https://alpinejs.dev/alpine.png" width="60" alt="Alpine.js Logo"> 
<img src="https://code.visualstudio.com/assets/images/code-stable.png" width="60" alt="VS Code Logo"> 
<img src="https://www.figma.com/favicon.ico" width="60" alt="Figma Logo">

⚙️ Cara Setup

🔧 Prasyarat
- Node.js & npm <img src="https://nodejs.org/static/images/logo.svg" width="40" alt="Node.js Logo">: Untuk dependensi frontend.
- Composer <img src="https://getcomposer.org/img/logo-composer-transparent.png" width="40" alt="Composer Logo">: Untuk dependensi PHP.
- XAMPP <img src="https://www.apachefriends.org/images/xampp-logo.svg" width="40" alt="XAMPP Logo">: Untuk server MySQL.
- PHP <img src="https://www.php.net/images/logos/new-php-logo.svg" width="40" alt="PHP Logo">: Versi kompatibel dengan Laravel.

🚀 Langkah-langkah
1. Clone repository:
   git clone https://github.com/your-repo/galeri-foto.git
   cd galeri-foto

2. Install dependensi:
   composer install
   npm install
   composer require intervention/image

3. Konfigurasi environment:
   cp .env.example .env
   Edit file .env untuk konfigurasi database. Pastikan XAMPP berjalan dan buat database bernama galeri.

4. Jalankan migrasi database:
   php artisan migrate

5. Jalankan aplikasi:
   php artisan serve
   npm run dev

6. Buka browser di http://localhost:8000 dan nikmati Galeri Foto! 🎉

💻 Kontribusi

Ingin ikut bikin keren? Fork repo ini, buat branch baru, dan kirim pull request! Pastikan kode kamu rapi dan ikuti panduan commit:
git add .
git commit -m "✨ Deskripsi perubahan"
git push origin nama-branch

📬 Kontak

Punya pertanyaan atau ide? Hubungi kami di email@example.com atau buka issue di GitHub. 💌

TERIMA KASIH! Ayo kelola foto dengan gaya bersama Galeri Foto! 📷✨

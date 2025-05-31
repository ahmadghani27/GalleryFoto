# 📸 PIXELORA

Selamat datang di **PIXELORA**, aplikasi web super keren berbasis **Laravel** untuk mengatur dan memamerkan koleksi foto kamu dengan mudah! 🚀 Upload, kelola, dan arsipkan foto dengan tampilan yang memukau, fitur canggih, dan pengalaman pengguna yang bikin betah. 😎

---

## 🌟 Apa Itu Galeri Foto?

**Galeri Foto** adalah aplikasi web untuk menyimpan dan menampilkan foto dengan judul dan URL yang tersimpan rapi di database. Dibuat dengan teknologi modern, aplikasi ini memudahkan kamu untuk mengelola foto dengan gaya! 💻✨

Menggunakan **Laravel** untuk backend, **XAMPP** untuk database MySQL, **Laravel Breeze** untuk autentikasi, **Blade Components** untuk antarmuka yang rapi, dan **Alpine.js** untuk interaktivitas yang ringan. Desainnya yang responsif didukung oleh **Tailwind CSS**, membuatnya tampak keren di semua perangkat! 📱💻

---

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

## 🛠️ Teknologi yang Digunakan

| **Teknologi**         | **Deskripsi**                                 | **Logo** |
|-----------------------|-----------------------------------------------|----------|
| **Laravel**           | Framework PHP untuk backend yang kuat         | <img src="https://laravel.com/img/logomark.min.svg" height="40" alt="Laravel Logo"> |
| **Blade Components**  | Template frontend untuk UI yang rapi          | <img src="https://laravel.com/img/logomark.min.svg" height="40" alt="Blade Logo"> |
| **MySQL (XAMPP)**     | Database untuk menyimpan data foto            | <img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" height="40" alt="MySQL Logo"> |
| **Laravel Breeze**    | Autentikasi ringan untuk login/register       | <img src="https://raw.githubusercontent.com/laravel/breeze/976ab1e2f68b90eee5a787445ff94033d919be2f/art/logo.svg" height="40" alt="Laravel Breeze Logo"> |
| **Tailwind CSS**      | Framework CSS untuk desain responsif          | <img src="https://cdn.worldvectorlogo.com/logos/tailwind-css-2.svg" height="40" alt="Tailwind CSS Logo"> |
| **Alpine.js**         | JavaScript ringan untuk interaktivitas        | <img src="https://icon.icepanel.io/Technology/png-shadow-512/Alpine.js.png" height="40" alt="Alpine.js Logo"> |
| **VS Code**           | Editor kode untuk pengembangan                | <img src="https://code.visualstudio.com/assets/images/code-stable.png" height="40" alt="VS Code Logo"> |
| **Figma**             | Alat desain untuk UI/UX                       | <img src="https://upload.wikimedia.org/wikipedia/commons/3/33/Figma-logo.svg" height="40" alt="Figma Logo"> |

---

## ⚙️ Cara Setup

### 🔧 Prasyarat
- **Node.js & npm** : Untuk dependensi frontend.
- **Composer** : Untuk dependensi PHP.
- **XAMPP** : Untuk server MySQL.
- **PHP** : Versi kompatibel dengan Laravel (lihat dokumentasi).

### Langkah-langkah
1. Clone repository:
   ```bash
   git clone https://github.com/your-repo/galeri-foto.git
   cd galeri-foto
   ```

2. Install dependensi:
   ```bash
   composer install
   npm install
   composer require intervention/image
   ```

3. Konfigurasi environment:
   ```bash
   cp .env.example .env
   ```
   Edit file `.env` untuk konfigurasi database (pastikan XAMPP sudah berjalan dan buat database bernama `galeri`).

4. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

5. Jalankan aplikasi:
   ```bash
   php artisan serve
   npm run dev
   ```

6. Buka browser di `http://localhost:8000` dan nikmati Galeri Foto! 🎉

---

# TERIMA KASIH

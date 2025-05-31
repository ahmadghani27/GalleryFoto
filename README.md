# 📸 Galeri Foto

Selamat datang di **Galeri Foto**, aplikasi web keren berbasis **Laravel** untuk mengatur dan memamerkan koleksi foto kamu dengan mudah! 🚀 Upload, kelola, dan arsipkan foto dengan tampilan yang menawan, fitur canggih, dan pengalaman pengguna yang super nyaman.

---

## 🌟 Apa Itu Galeri Foto?

Galeri Foto adalah aplikasi web untuk menyimpan dan menampilkan foto dengan judul dan URL yang tersimpan rapi di database. Dibangun dengan **Laravel**, aplikasi ini menggunakan **XAMPP** untuk mengelola database MySQL, **Laravel Breeze** untuk autentikasi, **Blade Components** untuk antarmuka yang rapi, dan **Alpine.js** untuk interaktivitas ringan di sisi klien.

Fitur utamanya meliputi CRUD untuk foto dan folder, upload massal, pencarian, pengarsipan, hingga manajemen akun pengguna. Semuanya dikemas dalam desain yang intuitif dan responsif menggunakan **Tailwind CSS**.

---

## 🎉 Fitur Unggulan

- 📤 **Upload Foto**: Unggah satu atau banyak foto sekaligus, judul otomatis diambil dari nama file.
- 📁 **Manajemen Folder**: Buat, edit, hapus folder, serta pindahkan foto ke folder secara massal.
- 🔍 **Pencarian Cepat**: Cari foto berdasarkan judul atau nama folder dengan hasil instan.
- 🔒 **Arsip Aman**: Lindungi foto dengan kata sandi untuk privasi ekstra.
- ✅ **Operasi Massal**: Hapus atau pindahkan banyak foto sekaligus dengan checkbox dan tombol batal.
- ⭐ **Favorit**: Tandai foto favorit untuk akses cepat.
- 🔄 **Urutkan Foto**: Urutkan foto berdasarkan tanggal (terbaru/terlama).
- 👤 **Akun Pengguna**: Login dan register dengan aman menggunakan **Laravel Breeze**.
- 📊 **Detail Foto**: Lihat informasi seperti nama, tanggal upload, dan ukuran file.

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel (Backend & Autentikasi dengan Laravel Breeze)
- **Database**: MySQL (Dikelola via XAMPP)
- **Frontend**: Blade Components, Tailwind CSS, Alpine.js
- **Tools**: VS Code, Figma

---

## ⚙️ Cara Setup

### Prasyarat
- **Node.js** & **npm**: Untuk mengelola dependensi frontend.
- **Composer**: Untuk mengelola dependensi PHP.
- **XAMPP**: Untuk menjalankan server MySQL.
- **PHP**: Versi yang kompatibel dengan Laravel (lihat dokumentasi Laravel).

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

## 💻 Kontribusi

Ingin berkontribusi? Fork repo ini, buat branch baru, dan kirim pull request. Pastikan kode kamu rapi dan ikuti panduan commit:
```bash
git add .
git commit -m "Deskripsi perubahan"
git push origin nama-branch
```

---

## 📬 Kontak

Punya pertanyaan atau saran? Hubungi tim kami di [email@example.com](mailto:email@example.com) atau buka issue di GitHub.

Ayo kelola foto dengan gaya bersama **Galeri Foto**! 📷✨
```

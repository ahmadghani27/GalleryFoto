# 📸 Galeri Foto

---

Halo bro, selamat datang di **Galeri Foto**!  
Ini aplikasi galeri foto kece berbasis Laravel buat ngatur dan pamerin foto-foto dengan gampang. Kamu bisa upload, atur, sampai arsipin foto, plus ada fitur canggih kayak bikin folder, operasi massal, dan login akun.

Dibikin bareng tim, aplikasi ini punya tampilan oke, backend kuat, dan database yang rapi banget!

---

## 🚀 Apa Itu Galeri Foto?

Galeri Foto adalah aplikasi web yang nyimpen judul dan URL foto, lalu ditampilin pake tag HTML `<img>`.  
Aplikasi ini support CRUD buat foto dan folder, plus fitur keren seperti:  
- Upload banyak sekaligus  
- Hapus massal  
- Tandain favorit  
- Login akun  
- Dan lain-lain  

Database-nya bernama **galeri** dan dikelola pake XAMPP.

---

## 🌟 Fitur Keren

### Ngatur Foto
- Upload satu atau banyak foto sekaligus (judul otomatis dari nama file).  
- Foto disimpen di folder proyek, URL masuk database.  
- Lihat detail foto: nama, tanggal upload, ukuran.  
- Tandain favorit, urutin foto (terbaru-terlama).

### Ngatur Folder
- Bikin, edit, hapus folder (nama folder unik).  
- Pindahin foto ke folder yang ada atau bikin folder baru massal.

### Cari & Arsip
- Cari foto berdasarkan nama folder atau judul foto.  
- Arsipin foto dengan kata sandi agar aman.

### Operasi Massal
- Hapus banyak foto dengan checkbox, bisa dibatalin.  
- Upload banyak foto sekaligus, bisa dibatalin juga.

### Akun Pengguna
- Buat akun dengan username & password.  
- Login aman dengan Laravel Breeze.

### Urutin Foto
- Urutkan foto dari terbaru ke terlama atau sebaliknya.

---

## 🗄️ Struktur Database

| Tabel    | Kolom                                               | Kunci                      |
| -------- | -------------------------------------------------- | -------------------------- |
| **users**   | id (PK, int), username (varchar), password (varchar) | PK: id                     |
| **folders** | id (PK, int), name (varchar, unique)                  | PK: id                    |
| **photos**  | id (PK, int), title (varchar), url (varchar), folder_id (FK, int), created_at (timestamp), size (int), is_favorite (boolean) | PK: id, FK: folder_id      |
| **archives**| id (PK, int), photo_id (FK, int), password (varchar)  | PK: id, FK: photo_id       |

### Relasi
- **Users → Photos:** Satu pengguna bisa upload banyak foto (1-to-many).  
- **Folders → Photos:** Satu folder punya banyak foto (1-to-many).  
- **Photos → Archives:** Satu foto bisa diarsipin dengan kata sandi (1-to-1).

> Skema lengkap dan relasi digambar di DrawIO supaya makin jelas.

---

## 🛠️ Teknologi yang Dipake

| Komponen     | Teknologi                        |
| ------------ | ------------------------------- |
| Framework    | Laravel (backend & Laravel Breeze) |
| Database     | MySQL (dikelola dengan XAMPP)    |
| Frontend     | Blade Templates, Tailwind CSS    |
| Tools        | VS Code, Figma, DrawIO, GitHub, Word & Excel |

---

## 👥 Tim & Tugasnya

| Nama                         | Peran                   | Tugas Utama                                                                 |
| ----------------------------|-------------------------|----------------------------------------------------------------------------|
| Eurecsan Dewantoro Putro     | Leader, Frontend, Designer | Pimpin proyek, desain UI/UX (Figma), koding frontend, flowchart & prototipe |
| Nizar Retisalya Sulkazimah   | Database                 | Desain skema database, atur XAMPP, relasi tabel                           |
| Gayuh Aza                   | Database, Frontend       | Bantu desain database, koding frontend                                   |
| Ahmad Ediwan Ghani          | Backend, Tester, Frontend| Controller/model backend, test fitur, bantu frontend                     |
| M. Arrizal Rahman Adi Laksono| Tester                   | Bikin test case, checklist, catat hasil & saran                          |
| Tsabitah Sarah              | Designer                 | Desain layar UI/UX, bantu prototipe                                       |

---

## 📅 Jadwal Kerja (Minggu, 19 Mei 2025)

| Hari       | Kegiatan                                                                                   |
| ---------- | ----------------------------------------------------------------------------------------- |
| Minggu-Rabu| Desain UI/UX (layar, flowchart, prototipe), finalisasi database & relasi, frontend & backend coding, checklist testing |
| Rabu       | Rapat tim via Zoom untuk cek progress                                                    |
| Jumat      | Finalisasi desain UI/UX                                                                  |

---

## 🧪 Rencana Testing

- Uji semua fitur (CRUD, operasi massal, pencarian, login, dll).  
- Buat checklist detail dan kriteria sukses.  
- Catat hasil di Word/Excel.  
- Kasih saran perbaikan bila ada bug.

**Contoh Checklist:**

| Fitur        | Kriteria Sukses                                      |
| ------------ | --------------------------------------------------- |
| Upload Foto  | File tersimpan di folder, URL masuk DB, waktu tercatat |
| Hapus Massal | Checkbox dan tombol batal berfungsi dengan baik     |
| Pencarian    | Hasil sesuai nama folder atau judul foto             |

---

## ⚙️ Cara Setup

```bash
git clone https://github.com/your-repo/galeri-foto.git
cd galeri-foto

composer install
npm install

cp .env.example .env
# Isi konfigurasi database di .env

# Setup XAMPP, buat database 'galeri'

php artisan migrate

php artisan serve
npm run dev

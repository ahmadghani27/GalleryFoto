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

## 🌟 Fitur Terbaik😹

### Ngatur Foto🗿
- Upload satu atau banyak foto sekaligus (judul otomatis dari nama file).  
- Foto disimpen di folder proyek, URL masuk database.  
- Lihat detail foto: nama, tanggal upload, ukuran.  
- Tandain favorit, urutin foto (terbaru-terlama).

### Ngatur Folder🗿
- Bikin, edit, hapus folder (nama folder unik).  
- Pindahin foto ke folder yang ada atau bikin folder baru massal.

### Cari & Arsip🗿
- Cari foto berdasarkan nama folder atau judul foto.  
- Arsipin foto dengan kata sandi agar aman.

### Operasi Massal🗿
- Hapus banyak foto dengan checkbox, bisa dibatalin.  
- Upload banyak foto sekaligus, bisa dibatalin juga.

### Akun Pengguna🗿
- Buat akun dengan username & password.  
- Login aman dengan Laravel Breeze.

### Urutin Foto🗿
- Urutkan foto dari terbaru ke terlama atau sebaliknya.

---

## 🗄️ Struktur Database (Sementara) 👀

| Tabel    | Kolom                                               | Kunci                      |
| -------- | -------------------------------------------------- | -------------------------- |
| **users**   | id (PK, int), username (varchar), password (varchar) | PK: id                     |
| **folders** | id (PK, int), name (varchar, unique)                  | PK: id                    |
| **photos**  | id (PK, int), title (varchar), url (varchar), folder_id (FK, int), created_at (timestamp), size (int), is_favorite (boolean) | PK: id, FK: folder_id      |
| **archives**| id (PK, int), photo_id (FK, int), password (varchar)  | PK: id, FK: photo_id       |

### Relasi🤝
- **Users → Photos:** Satu pengguna bisa upload banyak foto (1-to-many).  
- **Folders → Photos:** Satu folder punya banyak foto (1-to-many).  
- **Photos → Archives:** Satu foto bisa diarsipin dengan kata sandi (1-to-1).

> Skema lengkap dan relasi digambar di DrawIO supaya makin jelas.

---

## 🛠️ Teknologi yang Dipakai

| Komponen     | Teknologi                        |
| ------------ | ------------------------------- |
| Framework    | Laravel (backend & Laravel Breeze) |
| Database     | MySQL (dikelola dengan XAMPP)    |
| Frontend     | Blade Templates, Tailwind CSS    |
| Tools        | VS Code, Figma |

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
```
```
# 1. Cek status perubahan di local
git status

# 2. Tambahkan file yang ingin di-commit (semua perubahan)
git add .

# 3. Commit dengan pesan yang jelas dan deskriptif
git commit -m "Tambah fitur upload foto dan buat folder"

# 4. Pastikan kamu berada di branch yang benar (misal: main atau develop)
git branch

# 5. Push commit ke remote repository
git push origin nama-branch

# 6. Jika perlu buat branch baru, gunakan
git checkout -b nama-branch-baru
```
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
# 📋 Daftar Tugas Tim Galeri Foto

Halo tim! Ini daftar tugas yang harus kita kerjain berdasarkan rencana proyek **Galeri Foto**. Semua tugas harus selesai sesuai timeline (Minggu - Jumat, 19-23 Mei 2025). Yuk, kita bagi-bagi tugas biar semuanya kecepetan! 🚀

---

## 🗓️ Timeline
- **Minggu - Rabu**: Desain, Database, Frontend, Backend, dan Tester nyiapin checklist.
- **Rabu**: Rapat via Zoom buat cek progress.
- **Jumat**: Desain selesai 100%.

---

## 👥 Tugas Per Anggota

### 1. Eurecsan Dewantoro Putro (Leader, Frontend, Designer)
- **Desain (Figma)**:
  - Bikin tampilan semua layar aplikasi (upload, folder, search, dll).
  - Gambar flowchart aplikasi biar alurnya jelas.
  - Buat prototipe interaktif di Figma.
- **Frontend**:
  - Kerjain kode tampilan bareng backend biar nama filenya sama.
  - Upload kode ke GitHub (selesai Rabu).
- **Leader**:
  - Pantau progress tim, pastiin semua on track.
  - Pimpin rapat Zoom hari Rabu.

### 2. Nizar Retisalya Sulkazimah (Database)
- **Database (XAMPP, DrawIO)**:
  - Desain tabel database `galeri` (users, folders, photos, archives).
  - Tentuin key (primary, foreign) dan tipe data tiap kolom.
  - Gambar relasi antar tabel pake DrawIO.
  - Selesain semua ini sebelum Rabu.

### 3. Gayuh Aza (Database, Frontend)
- **Database**:
  - Bantu Nizar desain tabel dan relasi database di XAMPP.
  - Pastiin schema-nya rapi dan sesuai kebutuhan.
- **Frontend**:
  - Bantu Eurecsan koding tampilan (Blade + Tailwind CSS).
  - Upload kode ke GitHub (selesai Rabu).

### 4. Ahmad Ediwan Ghani (Backend, Tester, Frontend)
- **Backend (Laravel)**:
  - Bikin controller dan model buat fitur CRUD (foto, folder).
  - Implementasi fitur lain: mass upload, mass delete, search, favorit, dll.
  - Pasang sistem akun pake Laravel Breeze.
  - Upload kode ke GitHub (selesai Rabu).👀
- **Frontend**:
  - Bantu Eurecsan dan Gayuh koding tampilan.
- **Tester**:
  - Uji fitur bareng Arrizal, catat hasilnya.

### 5. M. Arrizal Rahman Adi Laksono (Tester)
- **Testing (Word & Excel)**:
  - Rancang checklist buat tiap fitur (upload, delete, search, dll).
  - Tulis kriteria keberhasilan (contoh: "Foto ke-upload, URL tersimpan di DB").
  - Uji semua fitur bareng Ediwan, catat hasil di Word/Excel.
  - Kasih saran perbaikan kalau ada bug.
  - Selesain checklist dan kriteria sebelum Rabu.

### 6. Tsabitah Sarah (Designer)
- **Desain (Figma)**:
  - Bantu Eurecsan bikin tampilan semua layar aplikasi.
  - Pastiin desainnya user-friendly dan kece.
  - Bantu bikin prototipe interaktif di Figma.
  - Selesain desain sebelum Jumat.

---

## 📋 Daftar Fitur & Tugas Teknis
Berikut fitur-fitur yang harus dikerjain, dibagi berdasarkan bagian:

### 1. Upload Foto
- **Backend**: Controller buat upload file, simpan URL ke DB, catat waktu upload.
- **Frontend**: Form upload dengan field judul (otomatis dari nama file).
- **Database**: Kolom `title`, `url`, `created_at`, `size` di tabel `photos`.

### 2. Buat Folder
- **Backend**: Controller buat bikin folder (key: nama folder).
- **Frontend**: Form input nama folder.
- **Database**: Tabel `folders` dengan kolom `id`, `name`.

### 3. Pencarian
- **Backend**: Query buat cari foto berdasarkan nama folder atau judul.
- **Frontend**: Input search bar dengan hasil real-time.
- **Database**: Pastiin indeks di kolom `title` dan `name`.

### 4. Arsip Foto
- **Backend**: Controller buat arsip foto dengan sandi.
- **Frontend**: Form input sandi buat arsip.
- **Database**: Tabel `archives` dengan kolom `photo_id`, `password`.

### 5. Akun
- **Backend**: Setup Laravel Breeze buat login/register.
- **Frontend**: Halaman login dan register.
- **Database**: Tabel `users` dengan `username`, `password`.

### 6. Delete & Edit
- **Backend**: Controller buat hapus/edit foto dan folder.
- **Frontend**: Tombol delete/edit di UI.

### 7. Mass Delete
- **Backend**: Logic buat hapus banyak foto pake checkbox.
- **Frontend**: Checkbox di tiap foto + tombol cancel.

### 8. Mass Upload
- **Backend**: Handler buat upload banyak file sekaligus.
- **Frontend**: Form upload multiple files + tombol cancel.

### 9. Mass Foldering
- **Backend**: Logic buat pindah banyak foto ke folder.
- **Frontend**: Checkbox buat seleksi foto + dropdown folder.

### 10. Detail Foto
- **Backend**: Ambil data nama, tanggal, ukuran dari DB.
- **Frontend**: Halaman detail foto.

### 11. Favorit
- **Backend**: Toggle favorit di tabel `photos` (kolom `is_favorite`).
- **Frontend**: Tombol favorit (bintang/icon).

### 12. Sorting
- **Backend**: Query buat urutkan foto (terbaru/terlama).
- **Frontend**: Dropdown buat pilih opsi sorting.

---

## 💡 Catatan Penting
- Semua kode diupload ke GitHub, pastikan branch-nya rapi.
- Frontend dan backend kerja bareng biar nama file sinkron.
- Tester harus detail, catat semua bug dan saran, buat laporan sedetail mungkin😹.
- Kalau ada kendala, lapor ke Eurecsan ASAP.

Ayo semangat, tim! Kita bikin **Galeri Foto** yang keren bareng-bareng! 💪

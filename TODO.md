📋 Daftar Tugas Tim Galeri Foto
Halo tim! Ini daftar tugas yang harus kita kerjain berdasarkan rencana proyek Galeri Foto. Semua tugas harus selesai sesuai timeline (Minggu - Jumat, 19-23 Mei 2025). Yuk, kita bagi-bagi tugas biar semuanya kecepetan! 🚀

🗓️ Timeline

Minggu - Rabu: Desain, Database, Frontend, Backend, dan Tester nyiapin checklist.
Rabu: Rapat via Zoom buat cek progress.
Jumat: Desain selesai 100%.


👥 Tugas Per Anggota
1. Eurecsan Dewantoro Putro (Leader, Frontend, Designer)

Desain (Figma):
Bikin tampilan semua layar aplikasi (upload, folder, search, dll).
Gambar flowchart aplikasi biar alurnya jelas.
Buat prototipe interaktif di Figma.


Frontend:
Kerjain kode tampilan bareng backend biar nama filenya sama.
Upload kode ke GitHub (selesai Rabu).


Leader:
Pantau progress tim, pastiin semua on track.
Pimpin rapat Zoom hari Rabu.



2. Nizar Retisalya Sulkazimah (Database)

Database (XAMPP, DrawIO):
Desain tabel database galeri (users, folders, photos, archives).
Tentuin key (primary, foreign) dan tipe data tiap kolom.
Gambar relasi antar tabel pake DrawIO.
Selesain semua ini sebelum Rabu.



3. Gayuh Aza (Database, Frontend)

Database:
Bantu Nizar desain tabel dan relasi database di XAMPP.
Pastiin schema-nya rapi dan sesuai kebutuhan.


Frontend:
Bantu Eurecsan koding tampilan (Blade + Tailwind CSS).
Upload kode ke GitHub (selesai Rabu).



4. Ahmad Ediwan Ghani (Backend, Tester, Frontend)

Backend (Laravel):
Bikin controller dan model buat fitur CRUD (foto, folder).
Implementasi fitur lain: mass upload, mass delete, search, favorit, dll.
Pasang sistem akun pake Laravel Breeze.
Upload kode ke GitHub (selesai Rabu).


Frontend:
Bantu Eurecsan dan Gayuh koding tampilan.


Tester:
Uji fitur bareng Arrizal, catat hasilnya.



5. M. Arrizal Rahman Adi Laksono (Tester)

Testing (Word & Excel):
Rancang checklist buat tiap fitur (upload, delete, search, dll).
Tulis kriteria keberhasilan (contoh: "Foto ke-upload, URL tersimpan di DB").
Uji semua fitur bareng Ediwan, catat hasil di Word/Excel.
Kasih saran perbaikan kalau ada bug.
Selesain checklist dan kriteria sebelum Rabu.



6. Tsabitah Sarah (Designer)

Desain (Figma):
Bantu Eurecsan bikin tampilan semua layar aplikasi.
Pastiin desainnya user-friendly dan kece.
Bantu bikin prototipe interaktif di Figma.
Selesain desain sebelum Jumat.




📋 Daftar Fitur & Tugas Teknis
Berikut fitur-fitur yang harus dikerjain, dibagi berdasarkan bagian:
1. Upload Foto

Backend: Controller buat upload file, simpan URL ke DB, catat waktu upload.
Frontend: Form upload dengan field judul (otomatis dari nama file).
Database: Kolom title, url, created_at, size di tabel photos.

2. Buat Folder

Backend: Controller buat bikin folder (key: nama folder).
Frontend: Form input nama folder.
Database: Tabel folders dengan kolom id, name.

3. Pencarian

Backend: Query buat cari foto berdasarkan nama folder atau judul.
Frontend: Input search bar dengan hasil real-time.
Database: Pastiin indeks di kolom title dan name.

4. Arsip Foto

Backend: Controller buat arsip foto dengan sandi.
Frontend: Form input sandi buat arsip.
Database: Tabel archives dengan kolom photo_id, password.

5. Akun

Backend: Setup Laravel Breeze buat login/register.
Frontend: Halaman login dan register.
Database: Tabel users dengan username, password.

6. Delete & Edit

Backend: Controller buat hapus/edit foto dan folder.
Frontend: Tombol delete/edit di UI.

7. Mass Delete

Backend: Logic buat hapus banyak foto pake checkbox.
Frontend: Checkbox di tiap foto + tombol cancel.

8. Mass Upload

Backend: Handler buat upload banyak file sekaligus.
Frontend: Form upload multiple files + tombol cancel.

9. Mass Foldering

Backend: Logic buat pindah banyak foto ke folder.
Frontend: Checkbox buat seleksi foto + dropdown folder.

10. Detail Foto

Backend: Ambil data nama, tanggal, ukuran dari DB.
Frontend: Halaman detail foto.

11. Favorit

Backend: Toggle favorit di tabel photos (kolom is_favorite).
Frontend: Tombol favorit (bintang/icon).

12. Sorting

Backend: Query buat urutkan foto (terbaru/terlama).
Frontend: Dropdown buat pilih opsi sorting.


📅 Deadline Spesifik

Minggu - Rabu:
Desain: Layar, flowchart, prototipe.
Database: Schema, tabel, relasi.
Frontend: Kode tampilan selesai, upload ke GitHub.
Backend: Controller, model, Breeze selesai, upload ke GitHub.
Tester: Checklist dan kriteria selesai.


Rabu: Zoom meeting, cek progress.
Jumat: Desain final diserahin.


💡 Catatan Penting

Semua kode diupload ke GitHub, pastiin branch-nya rapi.
Frontend dan backend kerja bareng biar nama file sinkron.
Tester harus detail, catat semua bug dan saran.
Kalau ada kendala, lapor ke Eurecsan ASAP.

Ayo semangat, tim! Kita bikin Galeri Foto yang keren bareng-bareng! 💪

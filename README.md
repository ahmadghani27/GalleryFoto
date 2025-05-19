📸 Galeri Foto
Halo bro, selamat datang di Galeri Foto! Ini aplikasi galeri foto kece berbasis Laravel buat ngatur dan pamerin foto-foto dengan gampang. Kamu bisa upload, atur, sampe arsipin foto, plus ada fitur canggih kayak bikin folder, operasi massal, dan login akun. Dibikin bareng tim, aplikasi ini punya tampilan oke, backend kuat, dan database yang rapi banget!

🚀 Apa Itu Galeri Foto?
Galeri Foto adalah aplikasi web yang nyimpen judul dan URL foto, trus ditampilin pake tag HTML <img>. Aplikasi ini support CRUD buat foto dan folder, plus fitur keren kayak upload banyak sekaligus, hapus massal, dan favorit. Databasenya namanya galeri dan dikelola pake XAMPP.
Fitur Keren

Ngatur Foto:
Upload foto satu-satu atau banyak sekaligus (judul otomatis dari nama file).
Foto disimpen di folder proyek, URL-nya masuk database.
Bisa lihat detail foto (nama, tanggal upload, ukuran).
Tandain foto favorit, urutin dari terbaru ke terlama atau sebaliknya.


Ngatur Folder:
Bikin, edit, atau hapus folder (pake nama folder sebagai kunci).
Pindahin foto ke folder yang udah ada atau bikin baru secara massal.


Cari & Arsip:
Cari foto berdasarkan nama folder atau judul foto.
Arsipin foto pake kata sandi biar aman.


Operasi Massal:
Hapus banyak foto pake checkbox (bisa dibatalin).
Upload banyak foto sekaligus, bisa dibatalin juga.


Akun Pengguna:
Bikin akun pake username dan kata sandi.
Login aman pake Laravel Breeze.


Urutin Foto:
Urutin foto dari terbaru ke terlama atau terlama ke terbaru.




🗄️ Struktur Database
Database galeri dirancang buat ngelola foto, folder, pengguna, dan arsip dengan efisien. Ini skema tabelnya, lengkap sama kolom, kunci, dan relasinya.



Tabel
Kolom
Kunci



users
id (PK, int), username (varchar), password (varchar)
Primary: id


folders
id (PK, int), name (varchar, unique)
Primary: id


photos
id (PK, int), title (varchar), url (varchar), folder_id (FK, int), created_at (timestamp), size (int), is_favorite (boolean)
Primary: id, Foreign: folder_id


archives
id (PK, int), photo_id (FK, int), password (varchar)
Primary: id, Foreign: photo_id


Relasi

Users ↔ Photos: Satu pengguna bisa upload banyak foto (satu-ke-banyak).
Folders ↔ Photos: Satu folder bisa punya banyak foto (satu-ke-banyak).
Photos ↔ Archives: Satu foto bisa diarsipin dengan kata sandi (satu-ke-satu).

Digambar pake DrawIO biar lebih jelas!

🛠️ Teknologi yang Dipake

Framework: Laravel (buat backend & login pake Laravel Breeze)
Database: MySQL (dikelola pake XAMPP)
Frontend: Blade templates, Tailwind CSS (buat styling kece)
Tools:
Visual Studio Code (buat koding frontend & backend)
Figma (desain UI/UX)
DrawIO (skema database)
GitHub (nyimpen kode)
Microsoft Word & Excel (laporan testing)




👥 Tim & Tugasnya



Nama
Peran
Tugas



Eurecsan Dewantoro Putro
Leader, Frontend, Designer
Nge-lead proyek, desain UI/UX di Figma, koding frontend, bikin flowchart & prototipe


Nizar Retisalya Sulkazimah
Database
Desain skema database, atur



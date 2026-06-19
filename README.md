# SISTEM INFORMASI AKADEMIK (SIAKAD)

## A. DESKRIPSI APLIKASI

Sistem Informasi Akademik (SIAKAD) adalah aplikasi web berbasis Laravel yang dikembangkan untuk mengelola data akademik perguruan tinggi secara terintegrasi. Aplikasi ini mencakup manajemen data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, dan Kartu Rencana Studi (KRS) dengan dua level akses pengguna yaitu Administrator dan Mahasiswa.

**Teknologi yang Digunakan:**
- Framework : Laravel 11
- Database : MySQL 8.0
- Frontend : Bootstrap 5, Bootstrap Icons
- Library Pendukung : DomPDF (export PDF), Laravel UI (autentikasi)
- Bahasa Pemrograman : PHP 8.1

---

## B. FUNGSI SETIAP HALAMAN

### 1. Halaman Autentikasi

**Halaman Login** (`/login`)
Fungsi: Mengautentikasi pengguna berdasarkan email dan password yang telah terdaftar. Pengguna dapat memilih opsi "Ingat Saya" untuk menyimpan sesi login. Tersedia link menuju halaman lupa password.

**Halaman Register** (`/register`)
Fungsi: Mendaftarkan akun baru dengan mengisi nama lengkap, alamat email, password, dan konfirmasi password. Setelah registrasi, pengguna dapat login ke sistem.

**Halaman Lupa Password** (`/password/reset`)
Fungsi: Mengirimkan tautan reset password ke alamat email pengguna. Pengguna memasukkan email terdaftar dan sistem akan mengirimkan link untuk mengatur ulang password.

**Halaman Reset Password** (`/password/reset/{token}`)
Fungsi: Mengatur password baru setelah pengguna menerima token reset melalui email. Pengguna memasukkan password baru dan konfirmasi password.

**Halaman Konfirmasi Password** (`/password/confirm`)
Fungsi: Meminta konfirmasi password kembali untuk mengakses halaman yang memerlukan keamanan tambahan.

**Halaman Verifikasi Email** (`/email/verify`)
Fungsi: Menampilkan notifikasi bahwa pengguna perlu memverifikasi alamat email sebelum dapat mengakses fitur tertentu. Tersedia opsi untuk mengirim ulang link verifikasi.

---

### 2. Halaman Dashboard

**Dashboard Admin** (`/dashboard`)
Fungsi: Menampilkan ringkasan statistik data akademik yang terdiri dari total mahasiswa, total dosen, total mata kuliah, total jadwal, dan total KRS aktif. Dilengkapi dengan menu cepat berbentuk card untuk mengakses seluruh modul manajemen data.

**Dashboard Mahasiswa** (`/dashboard`)
Fungsi: Menampilkan informasi profil mahasiswa yang mencakup nama lengkap, NPM, program studi, total SKS yang diambil, jumlah KRS aktif, dan daftar mata kuliah yang sedang diikuti beserta jadwalnya.

---

### 3. Modul Manajemen Dosen (Admin)

**Halaman Daftar Dosen** (`/admin/dosen`)
Fungsi: Menampilkan seluruh data dosen dalam bentuk tabel yang berisi kolom NIDN, nama lengkap, email, nomor telepon, pendidikan terakhir, dan bidang keahlian. Dilengkapi dengan fitur pencarian berdasarkan NIDN, nama lengkap, atau email.

**Halaman Tambah Dosen** (`/admin/dosen/create`)
Fungsi: Formulir untuk menambahkan data dosen baru. Field yang tersedia meliputi NIDN, nama lengkap, email, nomor telepon, pendidikan terakhir, dan bidang keahlian.

**Halaman Edit Dosen** (`/admin/dosen/{id}/edit`)
Fungsi: Formulir untuk mengubah data dosen yang sudah terdaftar. Field yang tersedia sama dengan halaman tambah dosen dengan data terisi otomatis.

**Halaman Detail Dosen** (`/admin/dosen/{id}`)
Fungsi: Menampilkan informasi lengkap dosen dalam format dua kolom. Halaman ini juga menampilkan daftar jadwal mengajar dosen yang mencakup mata kuliah, hari, jam, kelas, ruangan, dan tahun akademik.

---

### 4. Modul Manajemen Mahasiswa (Admin)

**Halaman Daftar Mahasiswa** (`/admin/mahasiswa`)
Fungsi: Menampilkan seluruh data mahasiswa dalam bentuk tabel yang berisi kolom NPM, nama lengkap, email, program studi, semester, dan tahun masuk. Dilengkapi dengan fitur pencarian berdasarkan NPM atau nama lengkap.

**Halaman Tambah Mahasiswa** (`/admin/mahasiswa/create`)
Fungsi: Formulir untuk menambahkan data mahasiswa baru. Field yang tersedia meliputi NPM, nama lengkap, email, nomor telepon, program studi, semester, tahun masuk, dan alamat.

**Halaman Edit Mahasiswa** (`/admin/mahasiswa/{id}/edit`)
Fungsi: Formulir untuk mengubah data mahasiswa yang sudah terdaftar. Field yang tersedia sama dengan halaman tambah mahasiswa dengan data terisi otomatis.

**Halaman Detail Mahasiswa** (`/admin/mahasiswa/{id}`)
Fungsi: Menampilkan informasi lengkap mahasiswa. Halaman ini juga menampilkan daftar KRS yang diambil oleh mahasiswa yang mencakup kode mata kuliah, nama mata kuliah, SKS, dosen pengajar, jadwal, status, dan nilai.

---

### 5. Modul Manajemen Mata Kuliah (Admin)

**Halaman Daftar Mata Kuliah** (`/admin/matakuliah`)
Fungsi: Menampilkan seluruh data mata kuliah dalam bentuk tabel yang berisi kolom kode mata kuliah, nama mata kuliah, SKS, semester, dan deskripsi. Dilengkapi dengan fitur pencarian berdasarkan kode mata kuliah atau nama mata kuliah.

**Halaman Tambah Mata Kuliah** (`/admin/matakuliah/create`)
Fungsi: Formulir untuk menambahkan data mata kuliah baru. Field yang tersedia meliputi kode mata kuliah, nama mata kuliah, jumlah SKS, semester, dan deskripsi.

**Halaman Edit Mata Kuliah** (`/admin/matakuliah/{id}/edit`)
Fungsi: Formulir untuk mengubah data mata kuliah yang sudah terdaftar. Field yang tersedia sama dengan halaman tambah mata kuliah dengan data terisi otomatis.

**Halaman Detail Mata Kuliah** (`/admin/matakuliah/{id}`)
Fungsi: Menampilkan informasi lengkap mata kuliah. Halaman ini juga menampilkan daftar jadwal terkait yang mencakup hari, jam, dosen pengajar, kelas, ruangan, dan tahun akademik.

---

### 6. Modul Manajemen Jadwal (Admin)

**Halaman Daftar Jadwal** (`/admin/jadwal`)
Fungsi: Menampilkan seluruh data jadwal perkuliahan dalam bentuk tabel yang berisi kolom mata kuliah, dosen pengajar, hari, jam, kelas, ruangan, kuota, dan jumlah terisi. Dilengkapi dengan fitur pencarian berdasarkan mata kuliah atau nama dosen.

**Halaman Tambah Jadwal** (`/admin/jadwal/create`)
Fungsi: Formulir untuk menambahkan jadwal perkuliahan baru. Field yang tersedia meliputi mata kuliah, dosen pengajar, hari, jam mulai, jam selesai, kelas, ruangan, tahun akademik, semester, dan kuota.

**Halaman Edit Jadwal** (`/admin/jadwal/{id}/edit`)
Fungsi: Formulir untuk mengubah data jadwal yang sudah terdaftar. Field yang tersedia sama dengan halaman tambah jadwal dengan data terisi otomatis.

**Halaman Detail Jadwal** (`/admin/jadwal/{id}`)
Fungsi: Menampilkan informasi lengkap jadwal perkuliahan yang mencakup mata kuliah, SKS, dosen, hari, jam, kelas, ruangan, tahun akademik, semester, kuota, jumlah terisi, dan sisa kuota. Halaman ini juga menampilkan daftar mahasiswa yang mengambil mata kuliah tersebut.

---

### 7. Modul Manajemen KRS (Admin)

**Halaman Daftar KRS** (`/admin/krs`)
Fungsi: Menampilkan seluruh data KRS dalam bentuk tabel yang berisi kolom mahasiswa, NPM, mata kuliah, SKS, dosen, status, nilai, dan tahun akademik. Dilengkapi dengan fitur filter berdasarkan mahasiswa. Halaman ini juga menyediakan tombol export data ke format PDF, CSV, dan Excel sesuai dengan data yang difilter.

---

### 8. Modul Mahasiswa

**Halaman KRS Saya** (`/mahasiswa/krs`)
Fungsi: Menampilkan daftar mata kuliah yang sudah diambil oleh mahasiswa yang mencakup kode mata kuliah, nama mata kuliah, SKS, dosen pengajar, hari, jam, dan ruangan. Menampilkan total SKS yang diambil di bagian footer tabel. Tersedia tombol "Batal" untuk membatalkan mata kuliah dan tombol export ke format PDF, CSV, dan Excel.

**Halaman Ambil Mata Kuliah** (`/mahasiswa/krs/create`)
Fungsi: Menampilkan daftar jadwal yang tersedia untuk ditambahkan ke KRS. Sistem hanya menampilkan jadwal yang belum diambil oleh mahasiswa dan masih memiliki kuota tersedia. Setiap jadwal dilengkapi dengan tombol "Ambil" untuk menambahkan ke KRS.

**Halaman Jadwal Saya** (`/mahasiswa/jadwal`)
Fungsi: Menampilkan jadwal perkuliahan mahasiswa yang sudah diurutkan berdasarkan hari dan jam. Informasi yang ditampilkan meliputi hari, jam, kode mata kuliah, nama mata kuliah, SKS, dosen pengajar, ruangan, dan kelas.

---

## C. FITUR APLIKASI

**Fitur Wajib**

- Autentikasi dan otorisasi (Login, Register, Logout dengan 2 role)
- Manajemen data dosen (Create, Read, Update, Delete)
- Manajemen data mahasiswa (Create, Read, Update, Delete)
- Manajemen data mata kuliah (Create, Read, Update, Delete)
- Manajemen data jadwal (Create, Read, Update, Delete)
- Manajemen data KRS (Ambil dan batal mata kuliah)
- Validasi Laravel pada setiap form
- Migration dan Seeder
- Eloquent ORM dan Relationship
- Middleware untuk pembatasan akses berdasarkan role

**Fitur Bonus**

- Export KRS ke format PDF
- Export KRS ke format CSV
- Export KRS ke format Excel (.xls)
- Pencarian data pada halaman index dosen, mahasiswa, mata kuliah, dan jadwal
- Filter data KRS berdasarkan mahasiswa
- Dashboard statistik untuk admin dan mahasiswa

---

## D. CARA INSTALASI

**Prasyarat**
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 5.7 atau lebih tinggi

**Langkah Instalasi**

1. Clone repository
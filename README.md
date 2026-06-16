# CRUD Laravel Full

<p align="center">
  <img src="demo/preview.gif" alt="Demo Project" width="100%">
</p>

<p align="center">
  <strong>CRUD Laravel Full</strong> adalah project latihan CRUD berbasis Laravel yang dilengkapi autentikasi, middleware admin, tampilan Blade, dan layout Bootstrap.
</p>

---

## Daftar Isi

- [Tentang Project](#tentang-project)
- [Fitur](#fitur)
- [Demo Animasi](#demo-animasi)
- [Teknologi](#teknologi)
- [Persyaratan](#persyaratan)
- [Instalasi](#instalasi)
- [Konfigurasi `.env`](#konfigurasi-env)
- [Menjalankan Project](#menjalankan-project)
- [Struktur Folder](#struktur-folder)
- [Catatan Penting](#catatan-penting)

---

## Tentang Project

Project ini dibuat untuk tugas/praktikum Laravel dengan fokus pada penerapan MVC, CRUD, Blade View, layout template Bootstrap, middleware admin, dan pengelolaan data mahasiswa/siswa. Aplikasi ini cocok untuk pembelajaran dasar sampai menengah dalam pengembangan web menggunakan Laravel.

---

## Fitur

- Login dan register user.
- Middleware `admin.guard` untuk proteksi route.
- CRUD data student/mahasiswa.
- Upload dan tampilkan foto.
- Preview, download, dan export PDF.
- Layout Bootstrap SB Admin 2.
- Blade template dengan `@extends`, `@section`, `@yield`, `@include`, dan `@stack`.

---

## Demo Animasi

> Simpan GIF demo ke folder `demo/` lalu tampilkan di README.

```md
<p align="center">
  <img src="demo/preview.gif" alt="Preview CRUD Laravel Full" width="100%">
</p>
```

Kalau mau, kamu juga bisa tambahkan screenshot:

```md
<p align="center">
  <img src="demo/login.png" alt="Login Page" width="45%">
  <img src="demo/student-list.png" alt="Student List" width="45%">
</p>
```

---

## Teknologi

- PHP 8.3
- Laravel 13
- MySQL
- Bootstrap
- Blade Template Engine
- JavaScript
- Laragon

---

## Persyaratan

Pastikan sudah terpasang:

- PHP
- Composer
- MySQL
- Laragon / XAMPP / Apache
- Node.js dan NPM jika diperlukan

---

## Instalasi

1. Clone repository ini:

```bash
git clone https://github.com/username/crud_laravel_full.git
cd crud_laravel_full
```

2. Install dependency PHP:

```bash
composer install
```

3. Install dependency frontend jika diperlukan:

```bash
npm install
npm run build
```

4. Copy file `.env`:

```bash
copy .env.example .env
```

Kalau file `.env.example` tidak ada, buat `.env` manual.

5. Generate APP key:

```bash
php artisan key:generate
```

---

## Konfigurasi `.env`

Sesuaikan bagian database:

```env
APP_NAME=CRUD Laravel Full
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_laravel_full
DB_USERNAME=root
DB_PASSWORD=
```

Jika memakai upload foto:

```env
FILESYSTEM_DISK=public
```

---

## Menjalankan Project

1. Jalankan migrasi:

```bash
php artisan migrate
```

Jika database masih baru dan ingin reset total:

```bash
php artisan migrate:fresh
```

2. Jalankan storage link jika upload file dipakai:

```bash
php artisan storage:link
```

3. Jalankan server:

```bash
php artisan serve
```

4. Buka browser:

```text
http://127.0.0.1:8000
```

---

## Struktur Folder

```bash
resources/views/
├── layouts/
│   ├── admin.blade.php
│   └── components/
│       ├── sidebar.blade.php
│       ├── topbar.blade.php
│       └── footer.blade.php
├── student/
│   ├── index.blade.php
│   └── table.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
```

---

## Catatan Penting

- Route `/` diarahkan ke halaman login atau student sesuai middleware.
- Pastikan middleware `admin.guard` sudah terdaftar dengan benar.
- Jika gambar tidak tampil, cek path `asset()` dan letak file di folder `public`.
- Jika muncul error `MissingAppKeyException`, pastikan `APP_KEY` sudah terisi.
- Jika migrasi error karena tabel sudah ada, gunakan `php artisan migrate:fresh`.

---

## Lisensi

Project ini dibuat untuk kebutuhan pembelajaran dan tugas praktikum.

# SIMSKOS — Sistem Inventaris Kosmetik

Aplikasi web manajemen inventaris untuk toko kosmetik, dibangun sebagai proyek Ujian Akhir Semester mata kuliah Pemrograman Web Lanjut. Aplikasi ini membantu mencatat data produk, memantau pergerakan stok masuk/keluar, serta menghasilkan laporan inventori secara otomatis.

**Nama:** Muhammad Nafis
**NIM:** 230170185

---

## Fitur Utama

- **Autentikasi**: Login & Register dengan verifikasi email (Laravel Breeze)
- **CRUD Produk & Kategori**: kelola data produk kosmetik lengkap dengan foto, harga, dan stok
- **Manajemen Stok**: pencatatan stok masuk/keluar dengan riwayat pergerakan, dilengkapi search bar produk
- **Role & Hak Akses**: Admin (akses penuh) dan Staff (input stok saja)
- **Dashboard**: ringkasan total produk, nilai inventori, dan peringatan stok menipis
- **Export Laporan**: preview laporan sebelum diunduh, dalam format PDF dan Excel
- **REST API**: endpoint produk dengan autentikasi token (Laravel Sanctum), teruji di Postman
- **Responsive Design**: tampilan menyesuaikan desktop maupun mobile
- **Desain iOS-style**: font Inter, skema warna hijau, komponen ala iOS

---

## Teknologi yang Digunakan

- Laravel 11 (PHP 8.3)
- Laravel Breeze (Autentikasi)
- Laravel Sanctum (REST API Token)
- MySQL
- Tailwind CSS + Alpine.js
- barryvdh/laravel-dompdf (Export PDF)
- maatwebsite/excel (Export Excel)
- Laragon (local development environment)

---

## Cara Instalasi & Menjalankan

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Langkah instalasi

```bash
# 1. Clone repository
git clone https://github.com/username-kamu/simskos-inventaris.git
cd simskos-inventaris

# 2. Install dependency PHP & JavaScript
composer install
npm install

# 3. Salin file environment
cp .env.example .env
php artisan key:generate

# 4. Buat database MySQL, lalu sesuaikan .env
# DB_DATABASE=simskos_inventaris
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Jalankan migrasi & seeder (akun demo + data awal)
php artisan migrate --seed

# 6. Buat symbolic link storage (untuk foto produk)
php artisan storage:link

# 7. Compile asset frontend
npm run build

# 8. Jalankan server
php artisan serve
```

Buka `http://localhost:8000` di browser.

---

## Akun Demo

| Role | Email | Password |
|---|---|---|
| Admin | admin@simskos.test | password |
| Staff | staff@simskos.test | password |

---

## Dokumentasi Screenshot

### 1. Autentikasi

**Halaman Login**
_(tempel screenshot di sini)_

**Halaman Register**
_(tempel screenshot di sini)_

**Verifikasi Email**
_(tempel screenshot di sini — bisa dari inbox Mailtrap)_

### 2. Dashboard
_(tempel screenshot di sini)_

### 3. CRUD Produk

**Daftar Produk**
_(tempel screenshot di sini)_

**Tambah Produk**
_(tempel screenshot di sini)_

**Edit Produk**
_(tempel screenshot di sini)_

### 4. Kategori
_(tempel screenshot di sini)_

### 5. Manajemen Stok

**Input Stok (dengan search bar)**
_(tempel screenshot di sini)_

**Riwayat Stok**
_(tempel screenshot di sini)_

### 6. REST API — Pengujian Postman

**Login (mendapatkan token)**
_(tempel screenshot di sini)_

**GET Produk**
_(tempel screenshot di sini)_

**POST Tambah Produk**
_(tempel screenshot di sini)_

**PUT Update Produk**
_(tempel screenshot di sini)_

**DELETE Hapus Produk**
_(tempel screenshot di sini)_

### 7. Hak Akses Admin vs Staff

**Tampilan Sidebar Admin**
_(tempel screenshot di sini)_

**Tampilan Sidebar Staff**
_(tempel screenshot di sini)_

### 8. Responsive Design

**Tampilan Desktop**
_(tempel screenshot di sini)_

**Tampilan Mobile**
_(tempel screenshot di sini)_

### 9. Export Laporan

**Preview Laporan**
_(tempel screenshot di sini)_

**Hasil Export PDF**
_(tempel screenshot di sini)_

**Hasil Export Excel**
_(tempel screenshot di sini)_

---

## Struktur Role & Hak Akses

| Fitur | Admin | Staff |
|---|---|---|
| Dashboard | ✅ | ❌ |
| CRUD Produk | ✅ | ❌ |
| CRUD Kategori | ✅ | ❌ |
| Export Laporan | ✅ | ❌ |
| Input Stok Masuk/Keluar | ✅ | ✅ |
| Riwayat Stok | ✅ | ✅ |

---

## Catatan

Proyek ini dibuat untuk memenuhi tugas UAS Pemrograman Web Lanjut, bukan untuk produksi komersial. Data produk yang digunakan merupakan data referensi dari toko kosmetik keluarga sebagai studi kasus nyata.

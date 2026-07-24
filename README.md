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

# 8. Jalankan Aplikasi (Pilih salah satu metode)

# Opsi A: Menggunakan Virtual Host / Laragon (simskos-inventaris.test)
# Pastikan folder project berada di dalam directory laragon/www/
# Lalu buka browser dan kunjungi:
http://simskos-inventaris.test

# Opsi B: Menggunakan Laravel Artisan Serve (localhost:8000)
php artisan serve
# Lalu buka browser dan kunjungi:
http://localhost:8000
```

## Akun Demo

| Role | Email | Password |
|---|---|---|
| Admin | admin@simskos.test | password |
| Staff | staff@simskos.test | password |

---

## Dokumentasi Screenshot

### 1. Autentikasi

**Halaman Login**
<img width="1919" height="970" alt="Screenshot 2026-07-24 212133" src="https://github.com/user-attachments/assets/a7adedb8-7cfc-41bf-9b9d-aae3a02910cd" />

**Halaman Register**
<img width="1911" height="980" alt="Screenshot 2026-07-24 084652" src="https://github.com/user-attachments/assets/8597d177-f7bf-46b8-b166-9ea066de852f" />

**Verifikasi Email**
<img width="1919" height="979" alt="Screenshot 2026-07-24 084815" src="https://github.com/user-attachments/assets/4ad2f707-ca50-4f4c-b2f5-7844b9276af2" />

### 2. Dashboard
<img width="1918" height="973" alt="Screenshot 2026-07-24 212227" src="https://github.com/user-attachments/assets/3fe7a6f1-5a30-4e6d-bce1-d29a8484babe" />
### 3. CRUD Produk

**Daftar Produk**
<img width="1919" height="971" alt="Screenshot 2026-07-24 212304" src="https://github.com/user-attachments/assets/ec9ab8c6-4bee-45fa-a3e8-f6a33a4470db" />
**Tambah Produk**
<img width="1919" height="970" alt="Screenshot 2026-07-24 212345" src="https://github.com/user-attachments/assets/ff58cd4e-778b-43a4-8416-4692de97e993" />
**Edit Produk**
<img width="1919" height="970" alt="Screenshot 2026-07-24 212431" src="https://github.com/user-attachments/assets/0dce6af5-ba25-4a04-be76-000d6cd3a598" />
### 4. Kategori
<img width="1919" height="970" alt="Screenshot 2026-07-24 212457" src="https://github.com/user-attachments/assets/a0764247-01d8-40e4-9e08-e517e6432560" />

### 5. Manajemen Stok

**Input Stok (dengan search bar)**
<img width="1919" height="972" alt="Screenshot 2026-07-24 212545" src="https://github.com/user-attachments/assets/71035491-2c57-480a-9795-19f7555a714e" />

**Riwayat Stok**
<img width="1919" height="971" alt="Screenshot 2026-07-24 212809" src="https://github.com/user-attachments/assets/dd815493-fbe6-4b59-be1f-091562c49b2c" />

### 6. REST API — Pengujian Postman

**Login (mendapatkan token)**
<img width="1920" height="1080" alt="Screenshot 2026-07-20 101230" src="https://github.com/user-attachments/assets/0996745f-1306-4054-949a-f9c93b285a56" />

**GET Produk**
<img width="1920" height="1080" alt="Screenshot 2026-07-20 102039" src="https://github.com/user-attachments/assets/77e02869-66d1-429b-98b9-97b4e75439cc" />

**POST Tambah Produk**
<img width="1920" height="1080" alt="Screenshot 2026-07-20 102055" src="https://github.com/user-attachments/assets/fad4717c-f627-4332-aa8e-5acf565cf94a" />

**PUT Update Produk**
<img width="1920" height="1080" alt="Screenshot 2026-07-20 102103" src="https://github.com/user-attachments/assets/0c9d63f8-3f82-42f2-a11b-64eca9635f2b" />

**DELETE Hapus Produk**
<img width="1919" height="1079" alt="Screenshot 2026-07-24 091501" src="https://github.com/user-attachments/assets/d5d94112-23bc-4b64-a98e-bf04501ca985" />

### 7. Hak Akses Admin vs Staff

**Tampilan Sidebar Admin**
<img width="770" height="968" alt="Screenshot 2026-07-24 212907" src="https://github.com/user-attachments/assets/ec02c4f5-0f25-40a9-a3a0-73528e1505d3" />

**Tampilan Sidebar Staff**
<img width="733" height="970" alt="Screenshot 2026-07-24 212951" src="https://github.com/user-attachments/assets/686307de-1a8a-4c52-bcd5-40942aba821c" />

### 8. Responsive Design

**Tampilan Desktop**
<img width="1919" height="972" alt="Screenshot 2026-07-24 213035" src="https://github.com/user-attachments/assets/9cb4d926-1028-45b9-8c65-6a77c7f6f1a9" />
**Tampilan Mobile**
<img width="1920" height="1080" alt="Tampilan Mobile" src="https://github.com/user-attachments/assets/6d4ef8dc-47f4-4916-a246-e53a2308fb6c" />
### 9. Export Laporan

**Preview Laporan**
<img width="1919" height="970" alt="Screenshot 2026-07-24 213723" src="https://github.com/user-attachments/assets/6655be67-f157-4dc7-b5ee-aa182684fa6e" />

**Hasil Export PDF**
<img width="1919" height="1041" alt="Screenshot 2026-07-24 091805" src="https://github.com/user-attachments/assets/07ab24bb-4b06-447e-9cba-609d01dfcf46" />

**Hasil Export Excel**
<img width="1919" height="1079" alt="Screenshot 2026-07-24 091848" src="https://github.com/user-attachments/assets/c8917cd6-8653-4a9e-b2ea-138f90851e80" />

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

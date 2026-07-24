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
<img width="1914" height="1026" alt="Screenshot 2026-07-24 084150" src="https://github.com/user-attachments/assets/dad535ff-67aa-4468-936b-3acca80b0df7" />

**Halaman Register**
<img width="1911" height="980" alt="Screenshot 2026-07-24 084652" src="https://github.com/user-attachments/assets/8597d177-f7bf-46b8-b166-9ea066de852f" />

**Verifikasi Email**
<img width="1919" height="979" alt="Screenshot 2026-07-24 084815" src="https://github.com/user-attachments/assets/4ad2f707-ca50-4f4c-b2f5-7844b9276af2" />

### 2. Dashboard
<img width="1918" height="977" alt="Screenshot 2026-07-24 084922" src="https://github.com/user-attachments/assets/f2c2f759-8a8d-4cfd-b0d1-42e9b2e1e012" />

### 3. CRUD Produk

**Daftar Produk**
<img width="1917" height="982" alt="Screenshot 2026-07-24 084944" src="https://github.com/user-attachments/assets/98abbdf0-599f-43bd-bbca-8dec245d196b" />
**Tambah Produk**
<img width="1919" height="977" alt="Screenshot 2026-07-24 085009" src="https://github.com/user-attachments/assets/43c3dc62-cd98-4746-a00a-7ef6c5c198b1" />

**Edit Produk**
<img width="1918" height="979" alt="Screenshot 2026-07-24 085036" src="https://github.com/user-attachments/assets/b7bcffdf-b233-4aea-89f9-7a6f44392fcc" />

### 4. Kategori
<img width="1914" height="977" alt="Screenshot 2026-07-24 085104" src="https://github.com/user-attachments/assets/f1bc0352-d7b3-4524-93aa-0d66690e393b" />

### 5. Manajemen Stok

**Input Stok (dengan search bar)**
<img width="1913" height="977" alt="Screenshot 2026-07-24 090606" src="https://github.com/user-attachments/assets/2f710acd-1954-4c31-865e-44b38f827e95" />

**Riwayat Stok**
<img width="1915" height="983" alt="Screenshot 2026-07-24 090739" src="https://github.com/user-attachments/assets/edb9e2f0-b1ab-44b8-b0eb-ddded8c44a3a" />

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
<img width="537" height="980" alt="Screenshot 2026-07-24 091530" src="https://github.com/user-attachments/assets/37a1338d-deb0-4df6-a55f-d84936a5f6b9" />

**Tampilan Sidebar Staff**
<img width="308" height="629" alt="Screenshot 2026-07-24 091554" src="https://github.com/user-attachments/assets/50e3f5dc-daaa-4cf8-863e-bc61d3fc55fc" />

### 8. Responsive Design

**Tampilan Desktop**
<img width="1915" height="986" alt="Screenshot 2026-07-24 091628" src="https://github.com/user-attachments/assets/0a306981-7c04-4039-86c1-fcafb1c2f8ba" />

**Tampilan Mobile**
<img width="1913" height="1027" alt="Screenshot 2026-07-24 091712" src="https://github.com/user-attachments/assets/902d0eac-6928-4cef-98df-d5bcad90610a" />
### 9. Export Laporan

**Preview Laporan**
<img width="1911" height="975" alt="Screenshot 2026-07-24 091730" src="https://github.com/user-attachments/assets/b02b6cb0-90e6-45f5-af6c-409593e3e14a" />

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

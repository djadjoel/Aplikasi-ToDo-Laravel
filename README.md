# 📋 Laravel To-Do App

Aplikasi manajemen tugas (To-Do List) berbasis Laravel dengan autentikasi pengguna, verifikasi email, dashboard admin, dan RESTful API. Dibangun menggunakan Laravel 12, Bootstrap 5.3, dan Axios.

## 🚀 Fitur Utama

- ✅ CRUD tugas dengan filter selesai/belum
- 🔐 Autentikasi login & register (frontend dan backend)
- 📧 Verifikasi email & reset password manual
- 🛡️ Dashboard admin terproteksi
- 📊 Statistik tugas di dashboard (done / undone / semua)
- 🌐 API publik kutipan motivasi harian
- 🔄 AJAX + Toast + SweetAlert2 (frontend UX)

---

## ⚙️ Instruksi Setup Project

### 1. Clone Repository
```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
```

### 2. Clone Repository
```bash
composer install
npm install && npm run build
```

### 3. Salin File Environment
```bash
cp .env.example .env
```

### 4. Generate Key & Setup DB
```bash
php artisan key:generate
```
Lalu buka file .env dan atur konfigurasi database Anda:
- DB_DATABASE=todo_app
- DB_USERNAME=root
- DB_PASSWORD=

### 5. Migrasi & Seed Database
```bash
php artisan migrate
php artisan db:seed
```

### 6. Jalankan Aplikasi
```bash
php artisan serve
```

### 7. Akses
- Frontend: http://localhost:8000
- Login Admin: http://localhost:8000/default/login

### 8. Alur Penggunaan
- Buat akun melalui login admin
- Kelola tugas baik di frontend dan backend 

## Struktur Proyek
```bash
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/            → Dashboard dan manajemen tugas
│   │   ├── Api/              → Login & CRUD tugas via API
│   │   ├── Default/          → Login, register, verifikasi email backend
│   │   └── Publik/           → Tampilan publik & frontend
├── Models/
│   ├── Admin/ManajemenTask.php
│   └── User.php

resources/
├── views/
│   ├── admin/                → Tampilan dashboard admin
│   ├── auth/                 → Form login & register backend
│   ├── authapi/              → Form login frontend
│   └── publik/               → Tampilan frontend utama (beranda)

routes/
├── web.php                   → Web routes (admin, publik, frontend)
├── api.php                   → API routes (optional jika pakai Sanctum)

public/
├── css/ js/ images/          → Aset statis
```

## Teknologi yang Digunakan
- Backend: Laravel 12
- Frontend: Blade, Bootstrap 5.3, SweetAlert2, Toast (Bootstrap), Axios
- Database: MySQL
- API External: https://api.quotable.io (untuk kutipan motivasi)
- Autentikasi: Laravel Auth + Middleware manual
- Email Verification & Reset: Manual (tanpa package Laravel Breeze/Jetstream)

## Lisensi
Aplikasi ini dibuat untuk tujuan pembelajaran. Silakan gunakan atau modifikasi sesuai kebutuhan.

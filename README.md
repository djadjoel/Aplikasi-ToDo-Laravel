# 📋 Laravel To-Do App by djadjoel Mindset is DOA

Aplikasi manajemen tugas (To-Do List) berbasis Laravel dengan autentikasi pengguna, verifikasi email, dashboard admin, dan RESTful API. Dibangun menggunakan Laravel 12, Bootstrap 5.3, dan Axios.

## Demo
- https://aplikasi-todo-laravel-production.up.railway.app/login
- Demo bisa diakses 30 hari sejak 12-06-2025

## Data login
- Username: test@example.com
- Password: password

## 🚀 Fitur Utama

- ✅ CRUD tugas dengan filter selesai/belum
- 🔐 Autentikasi login & register (frontend dan backend)
- 📧 Verifikasi email & reset password manual
- 🛡️ Dashboard admin terproteksi
- 📊 Statistik tugas di dashboard (done / undone / semua)
- 🌐 API publik kutipan motivasi harian
- 🔄 AJAX + Toast + SweetAlert2 (frontend UX)

---

## ⚙️ Instruksi Penggunaan

### 1. Login Akses
- Frontend Login : https://aplikasi-todo-laravel-production.up.railway.app/login
- Backend Login Admin: https://aplikasi-todo-laravel-production.up.railway.app/default/login

### 2. Alur Penggunaan
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

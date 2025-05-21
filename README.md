<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 📋 Informasi Umum Aplikasi

### Akun Pengguna

| Email                     | Password |
| ------------------------- | -------- |
| **admin@company.com**     | password |
| **approver1@company.com** | password |
| **approver2@company.com** | password |

### Versi yang Digunakan

-   **PHP**: 8.4.6
-   **Laravel**: 12
-   **Database**: MySQL 8.0.40

---

## 🔑 Login & Akses

**Aplikasi dimulai dari: `/login`**  
Gunakan akun berikut untuk login:

> ⚠️ Jalankan seeder terlebih dahulu agar data akun tersedia:

```bash
php artisan migrate:fresh --seed

---

## 🚀 Panduan Penggunaan Aplikasi

### 🛠 Peran & Fitur

#### 👤 Admin
- Membuat permintaan booking kendaraan
- Booking akan disetujui jika **2 approver menyetujui** (level 2)
- Menambahkan kendaraan (vehicle) dan supir (driver)
- Mengekspor data booking ke format **Excel**

#### ✅ Approver
- Menyetujui permintaan booking dari admin
- Setiap booking memiliki **2 level persetujuan**
- **Satu approver hanya dapat meningkatkan 1 level**
- Booking dianggap "Approved" jika telah mencapai level 2 (disetujui oleh 2 approver)

---

## 📘 Belajar Laravel

Laravel memiliki dokumentasi yang sangat lengkap:
- 📖 [Laravel Documentation](https://laravel.com/docs)
- 🚀 [Laravel Bootcamp](https://bootcamp.laravel.com)
- 🎥 [Laracasts](https://laracasts.com)

---

## 👥 Kontribusi & Sponsor

Untuk kontribusi dan sponsor, silakan lihat bagian [Contributing](https://laravel.com/docs/contributions) dan [Laravel Partners](https://partners.laravel.com).

---

## 🔐 Keamanan

Jika Anda menemukan celah keamanan, segera kirim email ke [taylor@laravel.com](mailto:taylor@laravel.com).

---

## 📄 Lisensi

Aplikasi ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).
```

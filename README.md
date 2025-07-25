
# 🌙 SI Website Pesantren

Sistem Informasi Website Pesantren adalah platform digital berbasis Laravel yang dirancang untuk mengelola informasi kegiatan pesantren, proses PPDB (Penerimaan Peserta Didik Baru), galeri, berita, serta progress pembelajaran santri. Proyek ini dibuat untuk mempermudah komunikasi antara pihak pesantren, orang tua, dan calon santri.

---

## 📌 Fitur Utama

### 🔓 Halaman Publik
- Beranda
- Visi & Misi
- Program Akademik
- Detail Berita & Pencarian Berita
- Galeri & Fasilitas
- PPDB (Penerimaan Peserta Didik Baru)
- Kontak & Tentang Yayasan

### 📝 Formulir
- Formulir Pra-Pendaftaran
- Formulir Pendaftaran (dengan upload berkas PDF/JPG)

---

### 👨‍🏫 Halaman Admin
- Dashboard Admin
- Manajemen Hero (Beranda & PPDB)
- Tentang Pesantren (deskripsi, sejarah, visi misi)
- Fasilitas & Galeri
- Program Akademik & Ketua Program
- Jadwal Harian, Struktur Kelas
- FAQ & Testimoni
- Berita Pesantren
- Laporan Tahunan Santri (Wustho, Ulya, Takhosus, Idad)
- Manajemen PPDB
  - Syarat Pendaftaran
  - Cara Daftar
  - Biaya & Bank Pembayaran
  - Data Pendaftar
- Manajemen Santri
  - Profil Santri
  - Raport Santri
  - Hafalan Santri
  - Akun Orangtua

---

### 🧑‍🎓 Halaman Wali Kelas (Walas)
- Login khusus wali kelas
- Dashboard Walas
- Melihat dan mengelola santri per kelas
- Input/update raport dan hafalan santri
- Monitoring perkembangan akademik dan non-akademik
- Riwayat input dan laporan hasil belajar

---

### 👨‍👩‍👧 Halaman Orangtua
- Login Akun Orangtua
- Dashboard
- Melihat data anak dan progress
- Laporan nilai dan hafalan secara real-time

---

## ⚙️ Teknologi yang Digunakan

- Laravel 10+
- Blade Templating Engine
- MySQL
- Laravel Authentication
- PHPUnit
- Swagger (L5-Swagger) untuk dokumentasi API
- File Upload (PDF dan Image)
- UUID dan Storage File (private)

---

## 📂 Struktur Folder Swagger (L5-Swagger)

Swagger digunakan untuk dokumentasi API endpoint:

```bash
php artisan l5-swagger:generate
```

File dokumentasi Swagger akan muncul di:

```
/storage/api-docs
```

Akses Swagger UI di:
```
http://localhost:8000/api/documentation
```

> Pastikan ada anotasi `@OA\Info`, `@OA\Get`, `@OA\Post` dalam setiap Controller yang terdokumentasi.

---

## 🛠️ Instalasi Lokal

### 1. Clone repositori
```bash
git clone https://github.com/vinijf01/SI-Pesantren.git
cd SI-Pesantren
```

### 2. Install dependensi
```bash
composer install
```

### 3. Salin file `.env` & generate key
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Buat database & sesuaikan `.env`
Edit bagian ini sesuai database lokal kamu:
```
DB_DATABASE=si_pesantren
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan migrasi
```bash
php artisan migrate
```

### 6. Jalankan server lokal
```bash
php artisan serve
```

---

## 🚀 Rencana Pengembangan

- Modul pembayaran online
- Riwayat aktivitas santri per semester
- Email notifikasi untuk PPDB
- Dashboard grafik dinamis (charts.js atau Apex)

---

## 📸 Cuplikan UI

> (Tambahkan gambar atau screenshot tampilan halaman di sini untuk menarik perhatian)

---

## 📜 Lisensi

Frontend menggunakan template Kindedo dari ThemeForest yang telah dimodifikasi.  
Template tidak disertakan dalam repositori karena hak cipta.  
Lisensi template dapat ditemukan di: https://themeforest.net/licenses

---

## 🤝 Kontribusi

Pull request sangat diterima!  
Untuk perubahan besar, mohon buka issue terlebih dahulu untuk didiskusikan.

---

## ✨ Developer

Made with ❤️ by Vini Jumatul Fitri  
GitHub: [@vinijf01](https://github.com/vinijf01)

---

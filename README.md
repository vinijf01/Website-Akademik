
# 🌙 SI Website Pesantren

Sistem Informasi Website Pesantren adalah platform digital berbasis Laravel yang dirancang untuk mengelola informasi kegiatan pesantren, proses PPDB (Penerimaan Peserta Didik Baru), galeri, berita, serta progress pembelajaran santri. Proyek ini dibuat untuk mempermudah komunikasi antara pihak pesantren, orang tua, dan calon santri.

---
## 📸 Cuplikan UI

- Tampilan Beranda
  <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/a4c5ea04-b648-45ba-99ca-415b812bb403" />

- Tampilan PPDB
  <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/40c0ab10-c2e5-41b0-ba6c-d002b7a1368b" />

- Tampilan Login Admin
  <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/8116cbff-d796-44e3-9d81-bcd7813cc294" />

- DashBoard Admin (tampilan untuk dashboard orangtua dan walas hampir saya seperti gambar dibawah namun service nya lebih sederhana)
  <img width="1920" height="1080" alt="image" src="https://github.com/user-attachments/assets/28dbbe8d-327a-47b9-b49e-e69ea19d809e" />

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
git clone https://github.com/vinijf01/Website-Akademik.git
cd Website-Akademik
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
DB_DATABASE=w_a_pesantren
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

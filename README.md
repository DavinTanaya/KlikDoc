# KlikDoc

**KlikDoc** adalah platform layanan kesehatan digital yang dirancang untuk mempermudah akses layanan kesehatan secara online. Aplikasi ini menjembatani interaksi antara pasien dan tenaga medis secara efisien, menyediakan layanan mulai dari konsultasi hingga manajemen pengobatan dalam satu platform terintegrasi. Seluruh antarmuka (frontend) dibangun murni menggunakan templating engine **Blade** bawaan Laravel.

## 🚀 Fitur Utama

- **Sistem Autentikasi:** Login dan pendaftaran yang aman.
- **Dashboard Terpisah:** Antarmuka khusus dan terpersonalisasi untuk Pasien maupun Mitra Dokter.
- **Chat Konsultasi:** Fitur komunikasi interaktif untuk sesi konsultasi medis antara pasien dan dokter.
- **Pengingat Obat:** Sistem pengingat otomatis untuk membantu pasien mematuhi jadwal minum obat mereka.
- **Kalkulator BMI:** Penghitung BMI bagi para pengguna yang ingin hidup lebih sehat.
- **Kalender Menstruasi:** Untuk membantu para pengguna wanita melihat jadwal menstruasi yang baik.
- **Artikel Kesehatan:** Pusat informasi yang memuat berbagai artikel medis dan tips kesehatan terkini.
- **Apotek Online:** Apotek online bagi pengguna yang tidak dapat keluar rumah.
- **Klik Home:** Layanan kunjungan dokter ke rumah untuk melakukan pemeriksaan kesehatan dan layanan kesehatan lainnya.
- **Sistem Pembayaran:** Halaman checkout dan pembayaran yang terintegrasi untuk layanan konsultasi, apotek online, dan KlikHome.
- **Registrasi Mitra Dokter:** Alur pendaftaran mandiri bagi dokter yang ingin bergabung sebagai mitra di platform KlikDoc.

## 🛠️ Cara Menjalankan Project (Local Development)

Project ini dibangun secara monolitik menggunakan framework **Laravel** dengan **Blade.php** sebagai frontend. Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal Anda:

### 1. Clone Repositori
```bash
git clone [https://github.com/username-kalian/klikdoc.git](https://github.com/username-kalian/klikdoc.git)
cd klikdoc
```

### 2. Install Dependencies
Pastikan Anda telah menginstal Composer. (Node.js/NPM tidak diwajibkan karena frontend murni menggunakan Blade).
```bash
composer install
```

### 3. Konfigurasi Environment
Duplikasi file konfigurasi environment standar yang disediakan.
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan kredensial database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=klikdoc
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Migrasi Database
Pastikan database dengan nama `klikdoc` sudah dibuat di MySQL Anda, lalu jalankan perintah:
```bash
php artisan migrate
```

### 6. Jalankan Server Lokal
```bash
php artisan serve
```
Aplikasi sekarang dapat diakses melalui browser di `http://127.0.0.1:8000`.

## 👨‍💻 Pembuat

Project ini dikembangkan oleh:
- **Dean Febrio Denny-Xie**
- **Davin Tanaya**
- **Johanes Cedrick Wijaya**

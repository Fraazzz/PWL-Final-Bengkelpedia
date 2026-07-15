# 🛠️ Bengkelpedia - Sistem Pemesanan Layanan Bengkel

Proyek ini adalah tugas **Final Project** untuk mata kuliah **Pemrograman Web Lanjut** di **Universitas Dian Nuswantoro (UDINUS)**. Bengkelpedia adalah aplikasi berbasis web yang memudahkan pelanggan untuk melakukan **booking** servis kendaraan secara **online** dan terintegrasi dengan **payment gateway Midtrans**.

## 👨‍🎓 Identitas Mahasiswa
- **Nama:** Farras Hendi Praptama
- **NIM:** A11.2024.15731
- **Kelompok:** A11.4413

---

# 🚀 1. Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di **localhost**:

### 1. Clone repository

```bash
git clone https://github.com/Fraazzz/PWL-Final-Bengkelpedia.git
```

### 2. Masuk ke folder project

```bash
cd PWL-Final-Bengkelpedia
```

### 3. Install seluruh dependency menggunakan Composer

```bash
composer install
```

### 4. Buat database

Buka **phpMyAdmin**, kemudian buat database baru dengan nama:

```text
bengkel_db
```

### 5. Jalankan migration dan seeder

Perintah berikut akan membuat seluruh tabel beserta data awal secara otomatis.

```bash
php spark migrate --seed
```

### 6. Jalankan server CodeIgniter 4

```bash
php spark serve
```

### 7. Buka aplikasi

Akses aplikasi melalui browser pada alamat:

```text
https://bengkelpedia.fasthost.web.id/
```

---

# ⚙️ 2. Konfigurasi ENV

Untuk menghubungkan aplikasi dengan database dan Midtrans, lakukan konfigurasi berikut.

### 1. Salin file ENV

Ubah nama file:

```text
.env.example
```

menjadi

```text
.env
```

### 2. Ubah Environment

Pastikan isi file `.env` memiliki konfigurasi berikut:

```env
CI_ENVIRONMENT = development
```

### 3. Konfigurasi Database

Sesuaikan konfigurasi database seperti berikut (password dikosongkan jika menggunakan XAMPP standar).

```env
database.default.hostname = localhost
database.default.database = bengkel_db
database.default.username = root
database.default.password =
```

### 4. Konfigurasi Midtrans

Masukkan **Client Key** dan **Server Key Midtrans Sandbox** pada bagian konfigurasi Midtrans di dalam file `.env`.

---

# 👥 3. Akun Demo

Gunakan akun berikut untuk mencoba seluruh fitur aplikasi.

## 👨‍💼 Admin Bengkel

| Username | Password |
|----------|----------|
| `april` | `123` |

## 👤 User / Pelanggan

| Username | Password |
|----------|----------|
| `wahyu` | `123` |

## 👤 Montir

| Username | Password |
|----------|----------|
| `joko` | `123` |

---

## 📝 Catatan

- Pastikan **Composer**, **PHP**, dan **MySQL** telah terpasang di komputer Anda.
- Gunakan **XAMPP** atau **Laragon** agar proses instalasi lebih mudah.
- Aplikasi menggunakan **CodeIgniter 4** dan terintegrasi dengan **Midtrans Sandbox** sebagai payment gateway.

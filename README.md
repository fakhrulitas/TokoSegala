# TOKOSEGALA

Aplikasi Toko Online Sederhana berbasis **PHP Native** dan **MySQL**.

---

## Gambaran Umum

TOKOSEGALA adalah aplikasi toko online sederhana dengan dua peran utama, yaitu **Admin** dan **User**. Admin bertugas mengelola data produk, sedangkan user dapat melihat katalog, menambahkan produk ke keranjang, dan melakukan checkout secara simulatif. Aplikasi ini dibuat tanpa framework agar struktur kode mudah dipahami dan dikembangkan.

---

## Tujuan

- Menyediakan aplikasi toko online sederhana sebagai contoh implementasi
- Menerapkan sistem autentikasi dan pembagian hak akses
- Mengelola data produk menggunakan konsep CRUD
- Memberikan pengalaman dasar proses belanja online

---

## Fitur Utama

### Admin

- Login sebagai admin
- Menambah, mengedit, dan menghapus produk
- Upload gambar produk
- Mengelola stok produk

### User

- Registrasi dan login
- Melihat katalog dan detail produk
- Mencari produk
- Menambahkan produk ke keranjang
- Mengubah jumlah produk di keranjang
- Checkout (simulasi)

---

## Teknologi yang Digunakan

- PHP Native
- MySQL
- HTML
- CSS
- Bootstrap

---

## Struktur Folder

```
uas_toko_online.sql        → File import database (SQL dump)
│
TOKOSEGALA
│
├─ admin/
│   ├─ produk.php               → Daftar semua produk (CRUD - READ)
│   ├─ tambah_produk.php        → Form tambah produk baru
│   ├─ simpan_produk.php        → Proses simpan produk (CREATE)
│   ├─ edit_produk.php          → Form edit produk
│   ├─ update_produk.php        → Proses update produk (UPDATE)
│   └─ hapus_produk.php         → Proses hapus produk (DELETE)
│
├─ assets/
│   ├─ css/
│   │   └─ style.css              → File stylesheet utama
│   └─ images/                    → Gambar produk & banner
│
├─ auth/
│   ├─ login.php                  → Halaman login
│   ├─ login_proses.php           → Proses login
│   ├─ logout.php                 → Logout
│   ├─ register.php               → Registrasi user
│   └─ register_proses.php        → Proses registrasi
│
├─ config/
│   └─ koneksi.php                → Koneksi database
│
├─ user/
│   ├─ checkout.php               → Checkout user
│   ├─ keranjang.php              → Keranjang belanja
│   ├─ tambah_keranjang.php       → Tambah ke keranjang
│   ├─ update_keranjang.php       → Update jumlah produk
│
├─ index.php                  → Halaman utama katalog
├─ detail_produk.php          → Halaman detail produk
├─ hash.php                   → Script utility hashing password
├─ layout.php                 → Template layout (header, navbar, footer)
├─ search.php                 → Halaman pencarian produk
└─ README.md                  → Dokumentasi proyek

```

---

## Cara Menjalankan Aplikasi

1. Pindahkan folder **TOKOSEGALA** ke direktori `htdocs` pada XAMPP
2. Jalankan Apache dan MySQL melalui XAMPP Control Panel
3. Buka phpMyAdmin melalui browser
4. Buat database dengan nama:

   ```
   uas_toko_online
   ```

5. Import file `uas_toko_online.sql`
6. Pastikan konfigurasi koneksi database sudah benar pada `config/koneksi.php`
7. Akses aplikasi melalui browser:

   ```
   http://localhost/TOKOSEGALA
   ```

---

## Koneksi Database

Semua file PHP terhubung ke database melalui file `config/koneksi.php`. File ini berfungsi sebagai pusat koneksi sehingga memudahkan pengelolaan dan pemeliharaan aplikasi.

---

## Catatan

- File `uas_toko_online.sql` digunakan untuk import database
- Aplikasi masih bersifat sederhana dan dapat dikembangkan lebih lanjut
- Cocok digunakan sebagai bahan pembelajaran dan pengembangan dasar aplikasi web

---

## Lisensi

Bebas digunakan untuk keperluan pembelajaran dan pe

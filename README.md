# Web Sync

**Web Sync** adalah aplikasi backend yang dirancang untuk menerima dan menyimpan data yang dikirim dari lebih dari 100 aplikasi desktop. Setiap aplikasi desktop akan mengirim data dalam bentuk API request yang diproses dan disimpan oleh Web Sync. Proyek ini memanfaatkan teknologi Laravel untuk menangani permintaan API secara efisien dan aman, dengan tambahan beberapa fitur untuk pengelolaan data dan keamanan API.

## Deskripsi Proyek

Aplikasi ini berfungsi sebagai pusat penyimpanan data yang dikirim oleh aplikasi-aplikasi desktop. Setiap aplikasi desktop mengirim data lokal mereka dalam interval waktu yang singkat. Data yang dikirim terdiri dari beberapa jenis seperti informasi **Penjualan** dan **Accounting**, yang nantinya akan diproses dan disimpan dalam tabel-tabel yang relevan di basis data.

## Tujuan

Web Sync dirancang untuk:
1. Menerima data dari berbagai aplikasi desktop yang berjalan di berbagai perangkat.
2. Menyimpan data tersebut di basis data secara efisien, aman, dan terstruktur.
3. Mengelola akses API dengan pembatasan rate limit agar tetap responsif meski menerima banyak permintaan.
4. Memastikan keamanan API menggunakan autentikasi token (Laravel Sanctum).

## Teknologi yang Digunakan

- **Laravel**: Framework backend utama untuk mengelola API dan pemrosesan data.
- **Laravel Sanctum**: Autentikasi berbasis token untuk mengamankan endpoint API.
- **Queue**: Memproses data secara asynchronous untuk menghindari beban tinggi dan menjaga performa API.
- **API Rate Limiting**: Membatasi jumlah request per menit untuk setiap klien agar tidak membanjiri server.
- **MySQL**: Basis data utama yang menyimpan semua data yang dikirim oleh aplikasi desktop.

## Struktur Data

Proyek ini memiliki beberapa tabel utama untuk menyimpan data, termasuk:

### Penjualan
- **App_ID**: ID aplikasi yang mengirim data.
- **Server_ID**: ID server pengirim.
- **Kode_Transaksi**, **Tanggal**, **Kode_Customer**, dan sebagainya.

### Accounting
- **App_ID**: ID aplikasi yang mengirim data.
- **Server_ID**: ID server pengirim.
- **No_Bukti**, **Tanggal_Transaksi**, **No_Akun**, dan sebagainya.

## Instalasi

Untuk menjalankan proyek ini, pastikan Anda telah memiliki:
1. PHP 8 atau yang lebih baru.
2. Composer.
3. MySQL untuk database.
4. Redis (opsional) untuk menangani antrian jika diperlukan.

1. Clone repository:
   ```bash
   git clone <repository-url>
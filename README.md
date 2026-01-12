# 🎮 Rental PS Management System (GACOR KANG)

Project ini dibuat untuk memenuhi **Ujian Akhir Semester (UAS)** mata kuliah **Web Service**.
Aplikasi berbasis Web (PHP Native & JavaScript) untuk manajemen operasional Rental PlayStation, mencakup pencatatan durasi sewa (realtime timer), stok barang, membership, dan laporan keuangan.

## 👨‍🎓 Data Mahasiswa
* **Nama:** Rizal Latumasandhi Sudarto
* **NIM:** 23.01.53.0003
* **Mata Kuliah:** Web Service 
* **Kampus:** Universitas Stikubank (UNISBANK)

---

## 🚀 Fitur Unggulan
Aplikasi ini menyelesaikan masalah pencatatan manual di rental PS dengan fitur:
1.  **Realtime Billing Timer:** Perhitungan durasi & biaya otomatis (Server-side time, anti-cheat).
2.  **Point of Sales (POS):** Cetak struk pembayaran (support thermal printer) lengkap dengan detail pesanan F&B.
3.  **Member System:** Manajemen database member dengan fitur **Poin Member** dan status expired otomatis.
4.  **Inventory Management:** Stok snack/minuman berkurang otomatis saat dipesan.
5.  **Live Monitoring:** Dashboard interaktif untuk melihat status unit (Available/Occupied) secara realtime.
6.  **Financial Report:** Laporan omzet harian dan bulanan.

---

## 🛠️ Teknologi yang Digunakan
* **Backend (API):** PHP Native (REST API Architecture).
* **Frontend:** HTML5, Bootstrap 5, JavaScript (Fetch API - Asynchronous).
* **Database:** MySQL (MariaDB).
* **Tools:** VS Code, HeidiSQL, Laragon/XAMPP.

---

## 🗄️ Struktur Database (10 Tabel)
Sistem ini menggunakan 10 tabel yang saling berelasi untuk integritas data:
1.  `users` - Autentikasi admin/operator.
2.  `members` - Data pelanggan & poin membership.
3.  `units` - Data station/meja PS (Status: Available/Occupied).
4.  `unit_types` - Kategori unit (PS4/PS5) & harga per jam.
5.  `rentals` - Transaksi utama penyewaan (mencatat waktu start/end).
6.  `snacks` - Inventory makanan/minuman.
7.  `snack_orders` - Detail pesanan snack per transaksi rental.
8.  `payments` - Rekap pembayaran final (Sewa + Snack).
9.  `packages` - (Opsional) Data paket promo.
10. `games` - (Opsional) Katalog game yang tersedia.

---

## 📸 Tangkapan Layar (Screenshot)

**1. Dashboard Live Monitoring**
<img width="1366" height="768" alt="Screenshot (46)" src="https://github.com/user-attachments/assets/0730c4ee-4cc3-428b-9e2d-54ee336c877a" />


**2. Cetak Struk Pembayaran**
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/90e58978-fca9-4c9c-883f-dbbf550ce72b" />

---

## ⚙️ Cara Instalasi
1.  Clone repository ini.
2.  Import file `database_rental.sql` ke database MySQL (Buat database baru bernama `db_rental_ps`).
3.  Sesuaikan konfigurasi database di file `koneksi.php` jika diperlukan (default: user `root`, pass kosong).
4.  Jalankan di local server (Laragon/XAMPP).

Product Manager Haikal` sampai bagian Author ke README.md.

# Product Manager Haikal

## Deskripsi

Product Manager Haikal adalah aplikasi web sederhana yang digunakan untuk mengelola data produk.

Aplikasi ini dibuat menggunakan PHP dan MySQL dengan menerapkan konsep CRUD (Create, Read, Update, Delete).

Sistem dapat digunakan untuk menambahkan, menampilkan, mengubah, menghapus, dan mencari data produk.

---

## Tujuan Project

Project ini dibuat untuk menerapkan konsep dasar pengembangan aplikasi web berbasis database, khususnya:

* Penggunaan PHP
* Penggunaan MySQL
* Koneksi database menggunakan PDO
* Operasi CRUD
* Validasi input
* Prepared Statement
* Keamanan dasar aplikasi web
* Pencarian data menggunakan query SQL
* Pengelolaan data melalui database

---

## Fitur

Aplikasi memiliki beberapa fitur utama:

* Menambahkan produk
* Menampilkan daftar produk
* Mengubah data produk
* Menghapus produk
* Mencari produk berdasarkan nama
* Mencari produk berdasarkan kategori
* Validasi input produk
* Mencegah nama produk duplikat
* Validasi harga agar tidak negatif
* Validasi stok agar tidak negatif
* Prepared Statement
* PDO
* CSRF Token pada proses penghapusan
* Post/Redirect/Get (PRG)
* Responsive layout

---

## Data Produk

Data produk yang digunakan dalam sistem terdiri dari:

| Field      | Tipe Data     | Keterangan                     |
| ---------- | ------------- | ------------------------------ |
| id         | INT           | Primary Key dan Auto Increment |
| name       | VARCHAR(100)  | Nama produk                    |
| category   | VARCHAR(100)  | Kategori produk                |
| price      | DECIMAL(12,2) | Harga produk                   |
| stock      | INT           | Jumlah stok produk             |
| created_at | TIMESTAMP     | Waktu data dibuat              |
| updated_at | TIMESTAMP     | Waktu data diperbarui          |

---

## Teknologi yang Digunakan

Project ini menggunakan beberapa teknologi:

* PHP
* MySQL
* PDO
* HTML
* CSS
* XAMPP
* Visual Studio Code

---

## Struktur Folder

product_manager_haikal
│
├── config
│   └── db.php
│
├── index.php
├── create.php
├── edit.php
├── delete.php
├── style.css
├── store_db.sql
└── README.md

---

## Penjelasan File

### config/db.php

Digunakan untuk melakukan koneksi antara aplikasi PHP dengan database MySQL.

### index.php

Digunakan untuk:

* Menampilkan daftar produk
* Melakukan pencarian produk
* Menampilkan tombol Edit
* Menampilkan tombol Hapus

### create.php

Digunakan untuk menambahkan produk baru ke dalam database.

### edit.php

Digunakan untuk mengubah data produk yang sudah tersimpan.

### delete.php

Digunakan untuk menghapus data produk dari database menggunakan metode POST dan CSRF Token.

### style.css

Digunakan untuk mengatur tampilan dan layout aplikasi.

### store_db.sql

Berisi struktur database dan tabel yang digunakan oleh aplikasi.

### README.md

Berisi dokumentasi dan panduan penggunaan project.

---

## Persyaratan

Sebelum menjalankan aplikasi, pastikan komputer sudah memiliki:

* XAMPP
* PHP
* MySQL
* Browser
* Visual Studio Code

---

## Cara Menjalankan Project

### 1. Jalankan XAMPP

Buka XAMPP Control Panel.

Jalankan:

Apache
MySQL

Pastikan Apache dan MySQL dalam keadaan running.

### 2. Letakkan Project

Letakkan folder project di dalam folder htdocs.

Lokasi project:

C:\xamppbaru\htdocs\product_manager_haikal

### 3. Buat Database

Buka phpMyAdmin melalui browser:

[http://localhost/phpmyadmin](http://localhost/phpmyadmin)

Buat database dengan nama:

product_manager_haikal

### 4. Buat Tabel

Import file:

store_db.sql

ke database:

product_manager_haikal

File store_db.sql berisi struktur tabel products.

### 5. Periksa Konfigurasi Database

Buka file:

config/db.php

Konfigurasi database yang digunakan:

$host = '127.0.0.1';
$dbname = 'product_manager_haikal';
$username = 'root';
$password = '';

Jika konfigurasi MySQL pada komputer berbeda, sesuaikan nilai tersebut.

### 6. Jalankan Aplikasi

Buka browser dan akses:

[http://localhost/product_manager_haikal/](http://localhost/product_manager_haikal/)

Halaman utama aplikasi akan menampilkan daftar produk.

---

## CRUD

Aplikasi menerapkan konsep CRUD.

CRUD merupakan singkatan dari:

* Create
* Read
* Update
* Delete

### Create

Create digunakan untuk menambahkan data produk.

File:

create.php

Contoh data:

Nama Produk : Laptop ASUS
Kategori : Elektronik
Harga : 7500000
Stok : 10

### Read

Read digunakan untuk menampilkan data produk.

File:

index.php

Data produk ditampilkan dalam bentuk tabel.

### Update

Update digunakan untuk mengubah data produk.

File:

edit.php

Pengguna dapat mengubah:

* Nama produk
* Kategori
* Harga
* Stok

### Delete

Delete digunakan untuk menghapus data produk.

File:

delete.php

Proses penghapusan menggunakan metode POST dan CSRF Token.

---

## Alur Sistem

Alur penggunaan aplikasi:

Buka Aplikasi
│
▼
Halaman Daftar Produk
│
├── Tambah Produk
│       │
│       ▼
│   Validasi Data
│       │
│       ▼
│   Simpan ke Database
│
├── Edit Produk
│       │
│       ▼
│   Validasi Data
│       │
│       ▼
│   Update Database
│
├── Hapus Produk
│       │
│       ▼
│   Validasi CSRF
│       │
│       ▼
│   Hapus dari Database
│
└── Search Produk
│
▼
Cari Nama/Kategori

---

## Search

Aplikasi memiliki fitur pencarian produk.

Pencarian dapat dilakukan berdasarkan:

* Nama produk
* Kategori produk

Contoh pencarian:

[http://localhost/product_manager_haikal/?search=Mouse](http://localhost/product_manager_haikal/?search=Mouse)

Jika kata Mouse ditemukan pada nama atau kategori produk, data yang sesuai akan ditampilkan.

Tombol Reset digunakan untuk menampilkan kembali seluruh produk.

---

## Validasi Input

Sistem memiliki beberapa validasi untuk menjaga agar data yang dimasukkan sesuai dengan aturan.

### Nama Produk

Nama produk:

* Wajib diisi
* Minimal 3 karakter
* Tidak boleh memiliki nama yang sama dengan produk lain

### Kategori

Kategori:

* Wajib diisi

### Harga

Harga:

* Wajib diisi
* Harus berupa angka
* Tidak boleh bernilai negatif

### Stok

Stok:

* Wajib diisi
* Harus berupa bilangan bulat
* Tidak boleh bernilai negatif

---

## Keamanan

Aplikasi menggunakan beberapa mekanisme keamanan dasar.

### PDO

PDO digunakan untuk melakukan koneksi dan komunikasi antara PHP dengan database MySQL.

### Prepared Statement

Prepared Statement digunakan ketika menjalankan query yang menerima input.

Contoh:

$stmt = $pdo->prepare(
'SELECT * FROM products WHERE id = ?'
);

$stmt->execute([$id]);

Penggunaan Prepared Statement membantu memisahkan query SQL dari nilai input.

### htmlspecialchars()

htmlspecialchars() digunakan ketika menampilkan data ke halaman HTML.

Contoh:

htmlspecialchars($product['name'])

### CSRF Token

CSRF Token digunakan pada proses penghapusan data.

Token dibuat menggunakan session:

$_SESSION['csrf_token']

Kemudian token diperiksa sebelum proses penghapusan dilakukan.

---

## Post/Redirect/Get (PRG)

Aplikasi menggunakan pola Post/Redirect/Get setelah proses:

* Menambahkan produk
* Mengubah produk
* Menghapus produk

Contoh:

header('Location: index.php?success=created');
exit;

Dengan pola tersebut, setelah proses POST berhasil, pengguna diarahkan kembali ke halaman utama.

---

## Database

Nama database:

product_manager_haikal

Nama tabel:

products

Struktur tabel:

CREATE TABLE products (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL UNIQUE,
category VARCHAR(100) NOT NULL,
price DECIMAL(12,2) NOT NULL,
stock INT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP
);

---

## Pengujian

Beberapa pengujian yang dilakukan pada aplikasi:

| Pengujian              | Hasil    |
| ---------------------- | -------- |
| Menambah produk        | Berhasil |
| Menampilkan produk     | Berhasil |
| Mengubah produk        | Berhasil |
| Menghapus produk       | Berhasil |
| Mencari produk         | Berhasil |
| Validasi nama produk   | Berhasil |
| Validasi harga         | Berhasil |
| Validasi stok          | Berhasil |
| Mencegah nama duplikat | Berhasil |
| CSRF pada delete       | Berhasil |

---

## Contoh Data

Contoh data yang dapat digunakan:

| Nama Produk         | Kategori   |   Harga | Stok |
| ------------------- | ---------- | ------: | ---: |
| Laptop ASUS         | Elektronik | 7500000 |   10 |
| Mouse Logitech      | Aksesoris  |  150000 |   20 |
| Keyboard Mechanical | Aksesoris  |  500000 |   15 |

---

## Database SQL

File database disediakan dalam:

store_db.sql

File tersebut dapat digunakan untuk membuat database dan tabel yang diperlukan oleh aplikasi.

---

## Author

**M Haikal Syah Alam**

Project: **Product Manager Haikal**

<?php

session_start();

require_once __DIR__ . '/config/db.php';

/*
|--------------------------------------------------------------------------
| Buat CSRF Token
|--------------------------------------------------------------------------
*/

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


/*
|--------------------------------------------------------------------------
| Pastikan request menggunakan POST
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Metode request tidak diperbolehkan.');
}


/*
|--------------------------------------------------------------------------
| Cek CSRF Token
|--------------------------------------------------------------------------
*/

$csrfToken = $_POST['csrf_token'] ?? '';

if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
    die('CSRF token tidak valid.');
}


/*
|--------------------------------------------------------------------------
| Ambil ID produk
|--------------------------------------------------------------------------
*/

$id = $_POST['id'] ?? '';

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die('ID produk tidak valid.');
}


/*
|--------------------------------------------------------------------------
| Hapus produk
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare(
    'DELETE FROM products WHERE id = ?'
);

$stmt->execute([$id]);


/*
|--------------------------------------------------------------------------
| Kembali ke halaman utama
|--------------------------------------------------------------------------
*/

header('Location: index.php?success=deleted');
exit;
<?php

require_once __DIR__ . '/config/db.php';

$errors = [];
$name = '';
$category = '';
$price = '';
$stock = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $stock = trim($_POST['stock'] ?? '');

    // Validasi nama
    if ($name === '') {
        $errors[] = 'Nama produk wajib diisi.';
    } elseif (strlen($name) < 3) {
        $errors[] = 'Nama produk minimal 3 karakter.';
    }

    // Validasi kategori
    if ($category === '') {
        $errors[] = 'Kategori wajib diisi.';
    }

    // Validasi harga
    if ($price === '') {
        $errors[] = 'Harga wajib diisi.';
    } elseif (!is_numeric($price) || $price < 0) {
        $errors[] = 'Harga harus berupa angka dan tidak boleh negatif.';
    }

    // Validasi stok
    if ($stock === '') {
        $errors[] = 'Stok wajib diisi.';
    } elseif (filter_var($stock, FILTER_VALIDATE_INT) === false || $stock < 0) {
        $errors[] = 'Stok harus berupa bilangan bulat dan tidak boleh negatif.';
    }

    // Cek nama produk duplikat
    if (empty($errors)) {
        $stmt = $pdo->prepare(
            'SELECT COUNT(*) FROM products WHERE name = ?'
        );

        $stmt->execute([$name]);

        if ($stmt->fetchColumn() > 0) {
            $errors[] = 'Nama produk sudah ada.';
        }
    }

    // Simpan ke database
    if (empty($errors)) {

        $stmt = $pdo->prepare(
            'INSERT INTO products (name, category, price, stock)
             VALUES (?, ?, ?, ?)'
        );

        $stmt->execute([
            $name,
            $category,
            $price,
            $stock
        ]);

        // PRG: Post/Redirect/Get
        header('Location: index.php?success=created');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Tambah Produk</h1>
        <a href="index.php" class="btn-secondary">Kembali</a>
    </div>

    <?php if (!empty($errors)): ?>

        <div class="alert-error">

            <?php foreach ($errors as $error): ?>

                <p>
                    <?= htmlspecialchars($error) ?>
                </p>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <div class="card">

        <form method="POST">

            <div class="form-group">
                <label for="name">Nama Produk</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="<?= htmlspecialchars($name) ?>"
                    placeholder="Masukkan nama produk"
                >
            </div>

            <div class="form-group">
                <label for="category">Kategori</label>

                <input
                    type="text"
                    id="category"
                    name="category"
                    value="<?= htmlspecialchars($category) ?>"
                    placeholder="Contoh: Elektronik"
                >
            </div>

            <div class="form-group">
                <label for="price">Harga</label>

                <input
                    type="number"
                    id="price"
                    name="price"
                    value="<?= htmlspecialchars($price) ?>"
                    min="0"
                    step="0.01"
                    placeholder="Contoh: 150000"
                >
            </div>

            <div class="form-group">
                <label for="stock">Stok</label>

                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="<?= htmlspecialchars($stock) ?>"
                    min="0"
                    step="1"
                    placeholder="Contoh: 10"
                >
            </div>

            <button type="submit" class="btn-primary">
                Simpan Produk
            </button>

        </form>

    </div>

</div>

</body>
</html>
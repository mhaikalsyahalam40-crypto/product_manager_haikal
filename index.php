<?php

session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/config/db.php';


/*
|--------------------------------------------------------------------------
| Search / Filter Produk
|--------------------------------------------------------------------------
*/

$search = trim($_GET['search'] ?? '');

if ($search !== '') {

    $stmt = $pdo->prepare(
        'SELECT id, name, category, price, stock, created_at
         FROM products
         WHERE name LIKE ?
            OR category LIKE ?
         ORDER BY id DESC'
    );

    $keyword = '%' . $search . '%';

    $stmt->execute([
        $keyword,
        $keyword
    ]);

} else {

    $stmt = $pdo->prepare(
        'SELECT id, name, category, price, stock, created_at
         FROM products
         ORDER BY id DESC'
    );

    $stmt->execute();
}

$products = $stmt->fetchAll();


/*
|--------------------------------------------------------------------------
| Pesan Sukses
|--------------------------------------------------------------------------
*/

$success = '';

if (isset($_GET['success'])) {

    if ($_GET['success'] === 'created') {
        $success = 'Produk berhasil ditambahkan.';
    }

    if ($_GET['success'] === 'updated') {
        $success = 'Produk berhasil diperbarui.';
    }

    if ($_GET['success'] === 'deleted') {
        $success = 'Produk berhasil dihapus.';
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Product Manager Haikal</title>

    <link
        rel="stylesheet"
        href="style.css?v=2"
    >

</head>

<body>

<div class="container">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="header">

        <div>

            <h1>
                Product Manager
            </h1>

            <p>
                Manajemen data produk
            </p>

        </div>


        <a
            href="create.php"
            class="btn-primary"
        >
            + Tambah Produk
        </a>

    </div>


    <!-- =====================================================
         PESAN SUKSES
    ====================================================== -->

    <?php if ($success !== ''): ?>

        <div class="alert-success">

            <?= htmlspecialchars(
                $success,
                ENT_QUOTES,
                'UTF-8'
            ) ?>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         CARD DAFTAR PRODUK
    ====================================================== -->

    <div class="card">

        <h2>
            Daftar Produk
        </h2>


        <!-- =================================================
             SEARCH
        ================================================== -->

        <form
            method="GET"
            class="search-form"
        >

            <input
                type="text"
                name="search"
                value="<?= htmlspecialchars(
                    $search,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
                placeholder="Cari nama atau kategori produk..."
            >


            <button
                type="submit"
                class="btn-primary"
            >
                Cari
            </button>


            <a
                href="index.php"
                class="btn-secondary"
            >
                Reset
            </a>

        </form>


        <!-- =================================================
             TABEL PRODUK
        ================================================== -->

        <div class="table-container">

            <table class="product-table">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nama Produk</th>

                        <th>Kategori</th>

                        <th>Harga</th>

                        <th>Stok</th>

                        <th>Dibuat</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (empty($products)): ?>

                        <tr>

                            <td
                                colspan="7"
                                class="empty-data"
                            >
                                Belum ada produk.
                            </td>

                        </tr>

                    <?php else: ?>

                        <?php foreach ($products as $product): ?>

                            <tr>


                                <!-- ID -->

                                <td data-label="ID">

                                    <?= (int) $product['id'] ?>

                                </td>


                                <!-- Nama Produk -->

                                <td
                                    data-label="Nama Produk"
                                    class="product-name"
                                >

                                    <?= htmlspecialchars(
                                        $product['name'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                </td>


                                <!-- Kategori -->

                                <td data-label="Kategori">

                                    <?= htmlspecialchars(
                                        $product['category'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                </td>


                                <!-- Harga -->

                                <td data-label="Harga">

                                    Rp
                                    <?= number_format(
                                        $product['price'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                </td>


                                <!-- Stok -->

                                <td data-label="Stok">

                                    <?= (int) $product['stock'] ?>

                                </td>


                                <!-- Dibuat -->

                                <td data-label="Dibuat">

                                    <?= htmlspecialchars(
                                        $product['created_at'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>

                                </td>


                                <!-- Aksi -->

                                <td
                                    data-label="Aksi"
                                    class="action-cell"
                                >

                                    <a
                                        href="edit.php?id=<?= (int) $product['id'] ?>"
                                        class="btn-edit"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        method="POST"
                                        action="delete.php"
                                        class="delete-form"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?');"
                                    >

                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int) $product['id'] ?>"
                                        >

                                        <input
                                            type="hidden"
                                            name="csrf_token"
                                            value="<?= htmlspecialchars(
                                                $_SESSION['csrf_token'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>"
                                        >

                                        <button
                                            type="submit"
                                            class="btn-delete"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>

</html>
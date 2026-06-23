<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Include data products
require_once __DIR__ . '/../../data/products.php';
require_once __DIR__ . '/../../components/product-card/product-card.php';

// Ambil parameter filter, sort, dan search dari URL
$search_query = isset($_GET['search']) ? htmlspecialchars(trim($_GET['search'])) : '';
$filter_badge = isset($_GET['filter']) ? htmlspecialchars(trim($_GET['filter'])) : 'all';
$sort_by      = isset($_GET['sort']) ? htmlspecialchars(trim($_GET['sort'])) : 'default';

// Salin array asli agar tidak merubah data source
global $products;
$filtered_products = $products ?? [];

// 1. Proses Search
if ($search_query !== '') {
    $filtered_products = array_filter($filtered_products, function($product) use ($search_query) {
        // stripos untuk pencarian case-insensitive
        return stripos($product['name'], $search_query) !== false;
    });
}

// 2. Proses Filter Badge
if ($filter_badge !== 'all') {
    $filtered_products = array_filter($filtered_products, function($product) use ($filter_badge) {
        $product_badge = isset($product['badge']) ? strtolower($product['badge']) : '';
        return $product_badge === strtolower($filter_badge);
    });
}

// 3. Proses Sorting
if ($sort_by !== 'default') {
    usort($filtered_products, function($a, $b) use ($sort_by) {
        if ($sort_by === 'price_asc') {
            return $a['price'] <=> $b['price'];
        } elseif ($sort_by === 'price_desc') {
            return $b['price'] <=> $a['price'];
        } elseif ($sort_by === 'name_asc') {
            return strcasecmp($a['name'], $b['name']);
        } elseif ($sort_by === 'name_desc') {
            return strcasecmp($b['name'], $a['name']);
        }
        return 0;
    });
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop — Ann's Bakery</title>
    <link rel="stylesheet" href="../../assets/styles/main.css">
    <link rel="stylesheet" href="shop.css">
</head>
<body>

<?php
include '../../components/navbar/navbar.php';
?>

<main class="content">
    <div class="container shop-page">

        <div class="shop-header">
            <h1 class="shop-header__title">Koleksi Produk Kami</h1>
            <p class="shop-header__desc">Temukan berbagai macam kue premium dengan cita rasa istimewa untuk setiap momen berharga Anda.</p>
        </div>

        <section class="shop-controls">
            <form method="GET" action="shop.php" class="shop-form">

                <!-- Search Input -->
                <div class="shop-form__group">
                    <label for="search">Cari Produk</label>
                    <input type="text" id="search" name="search" class="shop-form__input" placeholder="Contoh: Cheesecake" value="<?= $search_query ?>">
                </div>

                <!-- Filter Kategori -->
                <div class="shop-form__group">
                    <label for="filter">Kategori</label>
                    <select id="filter" name="filter" class="shop-form__select" onchange="this.form.submit()">
                        <option value="all" <?= $filter_badge === 'all' ? 'selected' : '' ?>>Semua Produk</option>
                        <option value="Best Seller" <?= strtolower($filter_badge) === 'best seller' ? 'selected' : '' ?>>Best Seller</option>
                        <option value="New" <?= strtolower($filter_badge) === 'new' ? 'selected' : '' ?>>New</option>
                        <option value="Seasonal" <?= strtolower($filter_badge) === 'seasonal' ? 'selected' : '' ?>>Seasonal</option>
                    </select>
                </div>

                <!-- Sorting -->
                <div class="shop-form__group">
                    <label for="sort">Urutkan</label>
                    <select id="sort" name="sort" class="shop-form__select" onchange="this.form.submit()">
                        <option value="default" <?= $sort_by === 'default' ? 'selected' : '' ?>>Paling Sesuai (Default)</option>
                        <option value="price_asc" <?= $sort_by === 'price_asc' ? 'selected' : '' ?>>Harga: Terendah ke Tertinggi</option>
                        <option value="price_desc" <?= $sort_by === 'price_desc' ? 'selected' : '' ?>>Harga: Tertinggi ke Terendah</option>
                        <option value="name_asc" <?= $sort_by === 'name_asc' ? 'selected' : '' ?>>Nama: A - Z</option>
                        <option value="name_desc" <?= $sort_by === 'name_desc' ? 'selected' : '' ?>>Nama: Z - A</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="shop-form__submit">Terapkan</button>
            </form>
        </section>

        <!-- Product Grid -->
        <section class="shop-products">
            <?php if (empty($filtered_products)): ?>
                <div class="shop-empty">
                    <h3>Produk tidak ditemukan</h3>
                    <p>Maaf, kami tidak dapat menemukan produk yang sesuai dengan pencarian atau filter Anda.</p>
                    <a href="shop.php" class="shop-empty__reset">Hapus Semua Filter</a>
                </div>
            <?php else: ?>
                <?php render_product_grid($filtered_products); ?>
            <?php endif; ?>
        </section>

    </div>
</main>

<?php
include '../../components/footer/footer.php';
?>

</body>
</html>

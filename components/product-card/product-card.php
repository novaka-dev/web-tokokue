<?php
/**
 * product-card.php
 * Reusable product card component untuk Ann's Bakery
 * TIDAK ADA DEFINISI BASE_URL DI SINI
 */

// Cek apakah BASE_URL sudah didefinisikan
if (!defined('BASE_URL')) {
    // Fallback jika config.php tidak di-include
    define('BASE_URL', '/web-tokokue/');
}

/**
 * Format harga ke format Rupiah
 */
function format_rupiah(int $amount): string {
    return 'Rp. ' . number_format($amount, 0, ',', '.');
}

/**
 * Render satu kartu produk
 */
function render_product_card(array $product): void {
    $name   = htmlspecialchars($product['name']  ?? 'Produk');
    $price  = isset($product['price']) ? format_rupiah((int) $product['price']) : '';
    $image  = htmlspecialchars($product['image'] ?? '');
    $badge  = htmlspecialchars($product['badge'] ?? '');
    $alt    = $name;
    
    // Build image URL dengan BASE_URL
    $image_url = $image;
    if ($image && strpos($image, 'http') !== 0 && strpos($image, '/') !== 0) {
        $image_url = BASE_URL . $image;
    }
    
    $detail_url = BASE_URL . 'page/product-detail/product-detail.php?id=' . (int)($product['id'] ?? 0);
?>
    <article class="product-card" onclick="window.location='<?= $detail_url ?>'" style="cursor:pointer">
        <div class="product-card__image-wrap">
            <?php if ($image_url): ?>
                <img src="<?= $image_url ?>" alt="<?= $alt ?>" loading="lazy">
            <?php else: ?>
                <img src="https://placehold.co/400x400/f4f2ee/b5832a?text=No+Image" alt="No image available" loading="lazy">
            <?php endif; ?>

            <?php if ($badge): ?>
                <span class="product-card__badge"><?= $badge ?></span>
            <?php endif; ?>
        </div>

        <div class="product-card__body">
            <h3 class="product-card__name"><?= $name ?></h3>
            <?php if ($price): ?>
                <p class="product-card__price"><?= $price ?></p>
            <?php endif; ?>
        </div>
    </article>
<?php
}

/**
 * Render grid berisi banyak kartu produk
 */
function render_product_grid(array $products): void {
    if (empty($products)) {
        echo '<p>Tidak ada produk yang tersedia.</p>';
        return;
    }
?>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <?php render_product_card($product); ?>
        <?php endforeach; ?>
    </div>
<?php
}
?>
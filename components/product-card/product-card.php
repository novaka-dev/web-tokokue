<?php
/**
 * product-card.php
 * Reusable product card component untuk Ann's Bakery
 *
 * Cara pakai:
 *   $products = [...]; // array produk
 *   include 'product-card.php';
 *
 * Atau panggil fungsi render_product_grid($products) / render_product_card($product)
 * secara individual.
 *
 * Struktur array produk:
 *   [
 *     'name'   => string  — nama produk (wajib)
 *     'price'  => int     — harga dalam Rupiah, tanpa titik/koma (wajib)
 *     'image'  => string  — path / URL gambar (wajib)
 *     'badge'  => string  — label badge opsional, mis. "New", "Best Seller"
 *   ]
 */

/**
 * Format harga ke format Rupiah
 * Contoh: 590000 → "Rp. 590.000"
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
?>

  <article class="product-card">
      <div class="product-card__image-wrap">
          <?php if ($image): ?>
              <img src="<?= $image ?>" alt="<?= $alt ?>" loading="lazy">
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

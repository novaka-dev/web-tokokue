<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk — Ann's Bakery</title>
    <link rel="stylesheet" href="../../assets/styles/main.css">
</head>
<body>

<?php
include '../../components/navbar/navbar.php';  // ← tambah ini
require_once '../../data/products.php';

// Ambil ID produk dari URL: product-detail.php?id=1
$id      = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = null;

/** @var array $products */  // ← tambah ini
foreach ($products as $p) {
    if ($p['id'] === $id) {
        $product = $p;
        break;
    }
}

// Jika produk tidak ditemukan
if (!$product) {
    echo '<div class="container" style="padding:80px 24px;text-align:center;">
            <h2>Produk tidak ditemukan.</h2>
            <a href="index.php" style="color:#b5832a;">← Kembali ke semua produk</a>
          </div>';
    exit;
}

function format_rupiah(int $amount): string {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

$name          = htmlspecialchars($product['name']);
$price         = format_rupiah($product['price']);
$images        = $product['images'] ?? [$product['image']];
$badge         = htmlspecialchars($product['badge'] ?? '');
$cake_wording  = $product['cake_wording'] ?? false;
$details       = nl2br(htmlspecialchars($product['details']      ?? ''));
$storage_care  = nl2br(htmlspecialchars($product['storage_care'] ?? ''));
$main_image    = htmlspecialchars($images[0]);
?>

<main class="container detail-page">

    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="/web-tokokue">Semua Produk</a>
        <span>/</span>
        <span><?= $name ?></span>
    </nav>

    <!-- Product Top Section -->
    <section class="detail-top">

        <!-- Gallery -->
        <div class="detail-gallery">
            <div class="detail-gallery__thumbs">
                <?php foreach ($images as $i => $img): ?>
                    <button
                        class="detail-gallery__thumb <?= $i === 0 ? 'active' : '' ?>"
                        onclick="switchImage(this, '<?= htmlspecialchars($img) ?>')"
                        type="button"
                    >
                        <img src="<?= htmlspecialchars($img) ?>" alt="<?= $name ?> view <?= $i + 1 ?>">
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="detail-gallery__main">
                <img id="main-image" src="<?= $main_image ?>" alt="<?= $name ?>">
                <?php if ($badge): ?>
                    <span class="product-card__badge"><?= $badge ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Info -->
        <div class="detail-info">
          <h1 class="detail-info__name"><?= $name ?></h1>
          <p class="detail-info__price"><?= $price ?></p>

          <form method="POST" action="/web-tokokue/cart-action.php">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <input type="hidden" name="action" value="add">

            <?php if ($cake_wording): ?>
            <div class="detail-info__wording">
                <label class="detail-info__label">CAKE WORDING</label>
                <input type="text" name="cake_wording" maxlength="25" placeholder="Max. 25 Characters" class="detail-info__input">
            </div>
            <?php endif; ?>

            <!-- Quantity pakai input number bawaan HTML -->
            <div class="detail-info__actions">
                <input type="number" name="qty" value="1" min="1" max="99" class="detail-info__qty-input">

                <button type="submit" name="redirect" value="/web-tokokue/page/product-detail/product-detail.php?id=<?= $product['id'] ?>" class="btn btn--cart">
                    🛒 Tambahkan ke keranjang
                </button>
                <button type="submit" name="redirect" value="/web-tokokue/page/checkout/checkout.php" class="btn btn--buy">
                    ⚡ Beli sekarang
                </button>
            </div>

            <?php if ($cake_wording): ?>
            <p class="detail-info__note">Cake Wording: Max. 25 characters</p>
            <?php endif; ?>
          </form>
      </div>

    </section>

    <!-- Informasi Section -->
    <section class="detail-info-section">
        <h2 class="detail-info-section__title">Informasi</h2>

        <div class="detail-tabs">

            <!-- Tab: Details -->
            <div class="detail-tabs__item">
                <button
                    class="detail-tabs__trigger active"
                    type="button"
                    onclick="toggleTab(this)"
                >Details</button>
                <div class="detail-tabs__content active">
                    <p><?= $details ?></p>
                </div>
            </div>

            <!-- Tab: Storage & Care -->
            <?php if (!empty($product['storage_care'])): ?>
            <div class="detail-tabs__item">
                <button
                    class="detail-tabs__trigger"
                    type="button"
                    onclick="toggleTab(this)"
                >Storage &amp; Care</button>
                <div class="detail-tabs__content">
                    <p><?= $storage_care ?></p>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>

</main>

<script>
// Ganti gambar utama saat thumbnail diklik
function switchImage(btn, src) {
    document.getElementById('main-image').src = src;
    document.querySelectorAll('.detail-gallery__thumb').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

// Ubah kuantitas
function changeQty(delta) {
    const el  = document.getElementById('qty');
    const val = Math.max(1, parseInt(el.textContent) + delta);
    el.textContent = val;
}

// Toggle accordion tab
function toggleTab(trigger) {
    const content = trigger.nextElementSibling;
    const isOpen  = trigger.classList.contains('active');

    // Tutup semua
    document.querySelectorAll('.detail-tabs__trigger').forEach(t => {
        t.classList.remove('active');
        t.nextElementSibling.classList.remove('active');
    });

    // Buka yang diklik (kecuali sudah terbuka)
    if (!isOpen) {
        trigger.classList.add('active');
        content.classList.add('active');
    }
}
</script>

</body>
</html>

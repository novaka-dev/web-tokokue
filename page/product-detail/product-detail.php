<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk — Ann's Bakery</title>
    <link rel="stylesheet" href="../../assets/styles/main.css">
    <link rel="stylesheet" href="product-detail.css">
</head>
<body>

<?php
include '../../components/navbar/navbar.php';
require_once '../../data/products.php';
require_once '../../config.php';
/** @var array $products */
// Ambil ID produk dari URL
$id      = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = null;

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
            <a href="' . BASE_URL . 'index.php" style="color:#b5832a;">← Kembali ke semua produk</a>
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
$details       = nl2br(htmlspecialchars($product['details'] ?? ''));
$storage_care  = nl2br(htmlspecialchars($product['storage_care'] ?? ''));
$main_image    = htmlspecialchars($images[0]);

// Hitung total produk lain
$total_lainnya = count($products) - 1;

// Build URL gambar dengan BASE_URL
$main_image_url = BASE_URL . $main_image;
$thumb_images = [];
foreach ($images as $img) {
    $thumb_images[] = BASE_URL . $img;
}
?>

<main class="container">

    <!-- Breadcrumb -->
    <nav class="breadcrumb">
        <a href="<?= BASE_URL ?>page/shop/shop.php">Semua Produk</a>
        <span>/</span>
        <span><?= $name ?></span>
    </nav>

    <!-- WRAPPER: Detail + Sidebar -->
    <div class="detail-page-wrapper">

        <!-- ==========================================
             KOLOM KIRI: Detail Produk
             ========================================== -->
        <div class="detail-page-main">

            <!-- Product Top Section -->
            <section class="detail-top">

                <!-- Gallery dengan Thumbnail di KIRI -->
                <div class="detail-gallery">
                    <!-- Thumbnail di KIRI (vertical) -->
                    <div class="detail-gallery__thumbs">
                        <?php foreach ($thumb_images as $i => $img): ?>
                            <button
                                class="detail-gallery__thumb <?= $i === 0 ? 'active' : '' ?>"
                                onclick="switchImage(this, '<?= $img ?>')"
                                type="button"
                                aria-label="Thumbnail <?= $i + 1 ?>"
                            >
                                <img src="<?= $img ?>" alt="<?= $name ?> view <?= $i + 1 ?>" loading="lazy">
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Gambar Utama -->
                    <div class="detail-gallery__main">
                        <img id="main-image" src="<?= $main_image_url ?>" alt="<?= $name ?>">
                        <?php if ($badge): ?>
                            <span class="product-card__badge"><?= $badge ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Info Produk -->
                <div class="detail-info">
                    <h1 class="detail-info__name"><?= $name ?></h1>
                    <p class="detail-info__price"><?= $price ?></p>

                    <form method="POST" action="<?= BASE_URL ?>cart-action.php" id="add-to-cart-form">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="action" value="add">

                        <?php if ($cake_wording): ?>
                        <div class="detail-info__wording">
                            <label class="detail-info__label">CAKE WORDING</label>
                            <input type="text" name="cake_wording" id="cake_wording" maxlength="25" placeholder="Max. 25 Characters" class="detail-info__input">
                        </div>
                        <?php endif; ?>

                        <div class="detail-info__actions">
                            <input type="number" name="qty" id="qty-input" value="1" min="1" max="99" class="detail-info__qty-input">

                            <button type="submit" name="redirect" value="<?= BASE_URL ?>page/product-detail/product-detail.php?id=<?= $product['id'] ?>" class="btn btn--cart">
                                🛒 Tambahkan
                            </button>

                            <button type="button" class="btn btn--buy" onclick="buyNow()">
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

        </div>
        <!-- END: Kolom Kiri -->


        <!-- ==========================================
             KOLOM KANAN: Sidebar Produk Lainnya
             ========================================== -->
        <aside class="detail-sidebar">

            <h3 class="detail-sidebar__title">
                Produk Lainnya
                <span class="badge-count">(<?= $total_lainnya ?>)</span>
            </h3>

            <?php if ($total_lainnya > 0): ?>
                <ul class="detail-sidebar__list">
                    <?php foreach ($products as $p): ?>
                        <?php if ($p['id'] === $id) continue; ?>
                        <a href="<?= BASE_URL ?>page/product-detail/product-detail.php?id=<?= $p['id'] ?>" class="detail-sidebar__item">
                            <img
                                src="<?= BASE_URL . htmlspecialchars($p['image']) ?>"
                                alt="<?= htmlspecialchars($p['name']) ?>"
                                class="detail-sidebar__img"
                                loading="lazy"
                            >
                            <div class="detail-sidebar__info">
                                <div class="detail-sidebar__name"><?= htmlspecialchars($p['name']) ?></div>
                                <div class="detail-sidebar__price"><?= format_rupiah($p['price']) ?></div>
                                <?php if (!empty($p['badge'])): ?>
                                    <span class="detail-sidebar__badge"><?= htmlspecialchars($p['badge']) ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="detail-sidebar__empty">Belum ada produk lain.</p>
            <?php endif; ?>

        </aside>
        <!-- END: Kolom Kanan -->

    </div>
    <!-- END: detail-page-wrapper -->

</main>

<script>
// Ganti gambar utama saat thumbnail diklik
function switchImage(btn, src) {
    var mainImage = document.getElementById('main-image');
    if (mainImage) {
        mainImage.src = src;
    }

    var thumbs = document.querySelectorAll('.detail-gallery__thumb');
    thumbs.forEach(function(thumb) {
        thumb.classList.remove('active');
    });

    btn.classList.add('active');
}

// Toggle accordion tab
function toggleTab(trigger) {
    var content = trigger.nextElementSibling;
    var isOpen = trigger.classList.contains('active');

    var triggers = document.querySelectorAll('.detail-tabs__trigger');
    triggers.forEach(function(t) {
        t.classList.remove('active');
        if (t.nextElementSibling) {
            t.nextElementSibling.classList.remove('active');
        }
    });

    if (!isOpen) {
        trigger.classList.add('active');
        if (content) {
            content.classList.add('active');
        }
    }
}

// Fungsi Buy Now - redirect ke checkout dengan parameter
function buyNow() {
    var qty = document.getElementById('qty-input').value || 1;
    var wordingInput = document.querySelector('input[name=cake_wording]');
    var wording = wordingInput ? wordingInput.value : '';

    var url = '<?= BASE_URL ?>page/checkout/checkout.php?buy_now=<?= $product['id'] ?>&qty=' + qty;
    if (wording) {
        url += '&cake_wording=' + encodeURIComponent(wording);
    }
    window.location.href = url;
}
</script>

</body>
</html>

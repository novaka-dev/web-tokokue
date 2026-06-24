<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once '../../components/cart/cart.php';
require_once '../../config.php';

$items = cart_items();
$total = cart_total();
$count = cart_count();
$root  = BASE_URL;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang — Ann's Bakery</title>
    <link rel="stylesheet" href="../../assets/styles/main.css">
    <link rel="stylesheet" href="cart.css">
</head>
<body>

<?php include '../../components/navbar/navbar.php'; ?>

<main class="container cart-page">

    <nav class="breadcrumb">
        <a href="<?= $root ?>index.php">Semua Produk</a>
        <span>/</span>
        <span>Keranjang</span>
    </nav>

    <a href="<?= $root ?>index.php" class="btn-back">← Lanjut Belanja</a>
    <h1 class="cart-page__title">Keranjang <span>(<?= $count ?> item)</span></h1>

    <?php if (empty($items)): ?>
        <div class="cart-page__empty">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.3">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 01-8 0"/>
            </svg>
            <p>Keranjang kamu masih kosong</p>
            <a href="<?= $root ?>index.php">← Lihat semua produk</a>
        </div>

    <?php else: ?>

        <div class="cart-page__layout">

            <section class="cart-page__items">
                <ul class="cart-page__list">
                    <?php foreach ($items as $item): ?>
                    <li class="cart-page__item">
                        <img
                            src="<?= $root . htmlspecialchars($item['image']) ?>"
                            alt="<?= htmlspecialchars($item['name']) ?>"
                            class="cart-page__img"
                        >
                        <div class="cart-page__info">
                            <p class="cart-page__name"><?= htmlspecialchars($item['name']) ?></p>
                            <?php if (!empty($item['cake_wording'])): ?>
                                <p class="cart-page__wording">"<?= htmlspecialchars($item['cake_wording']) ?>"</p>
                            <?php endif; ?>
                            <p class="cart-page__price"><?= cart_format_rupiah($item['price']) ?></p>

                            <div class="cart-page__controls">
                                <form method="POST" action="<?= $root ?>cart-action.php" style="display:inline">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="qty" value="<?= $item['qty'] - 1 ?>">
                                    <input type="hidden" name="redirect" value="<?= $root ?>page/cart/cart.php">
                                    <button type="submit" class="cart-page__qty-btn">−</button>
                                </form>

                                <span class="cart-page__qty"><?= $item['qty'] ?></span>

                                <form method="POST" action="<?= $root ?>cart-action.php" style="display:inline">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="qty" value="<?= $item['qty'] + 1 ?>">
                                    <input type="hidden" name="redirect" value="<?= $root ?>page/cart/cart.php">
                                    <button type="submit" class="cart-page__qty-btn">+</button>
                                </form>

                                <form method="POST" action="<?= $root ?>cart-action.php" style="display:inline">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="redirect" value="<?= $root ?>page/cart/cart.php">
                                    <button type="submit" class="cart-page__remove">Hapus</button>
                                </form>
                            </div>
                        </div>

                        <p class="cart-page__subtotal">
                            <?= cart_format_rupiah($item['price'] * $item['qty']) ?>
                        </p>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <form method="POST" action="<?= $root ?>cart-action.php" class="cart-page__clear-form">
                    <input type="hidden" name="action" value="clear">
                    <input type="hidden" name="redirect" value="<?= $root ?>page/cart/cart.php">
                    <button type="submit" class="cart-page__clear">Kosongkan keranjang</button>
                </form>
            </section>

            <aside class="cart-page__summary">
                <h2 class="cart-page__summary-title">Ringkasan</h2>

                <div class="cart-page__summary-row">
                    <span>Subtotal (<?= $count ?> item)</span>
                    <span><?= cart_format_rupiah($total) ?></span>
                </div>

                <div class="cart-page__summary-divider"></div>

                <div class="cart-page__summary-total">
                    <span>Total</span>
                    <strong><?= cart_format_rupiah($total) ?></strong>
                </div>

                <a href="<?= $root ?>page/checkout/checkout.php" class="cart-page__checkout">
                    Checkout →
                </a>

                <a href="<?= $root ?>index.php" class="cart-page__continue">
                    ← Lanjut belanja
                </a>
            </aside>

        </div>

    <?php endif; ?>

</main>

<?php include '../../components/footer/footer.php'; ?>

</body>
</html>
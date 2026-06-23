<?php
/**
 * components/cart/cart-drawer.php
 * Sidebar drawer keranjang dari kanan
 * Include di header atau layout utama
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../cart/cart.php';

$items = cart_items();
$total = cart_total();
$count = cart_count();

// Tentukan path root relatif dari posisi file yang include drawer ini
$root = '/';
?>

<!-- Cart Toggle Button (taruh di header) -->
<button class="cart-toggle" onclick="toggleCart()" type="button" aria-label="Buka keranjang">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 01-8 0"/>
    </svg>
    <?php if ($count > 0): ?>
        <span class="cart-toggle__badge"><?= $count ?></span>
    <?php endif; ?>
</button>

<!-- Overlay -->
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>

<!-- Drawer -->
<aside class="cart-drawer" id="cartDrawer">

    <div class="cart-drawer__header">
        <h2 class="cart-drawer__title">Keranjang <span>(<?= $count ?>)</span></h2>
        <button class="cart-drawer__close" onclick="toggleCart()" type="button">✕</button>
    </div>

    <div class="cart-drawer__body">
        <?php if (empty($items)): ?>
            <div class="cart-drawer__empty">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 01-8 0"/>
                </svg>
                <p>Keranjang kamu masih kosong</p>
                <a href="<?= $root ?>index.php" onclick="toggleCart()">Lihat produk →</a>
            </div>
        <?php else: ?>
            <ul class="cart-drawer__list">
                <?php foreach ($items as $item): ?>
                <li class="cart-item">
                    <img
                        class="cart-item__image"
                        src="<?= $root . htmlspecialchars($item['image']) ?>"
                        alt="<?= htmlspecialchars($item['name']) ?>"
                    >
                    <div class="cart-item__info">
                        <p class="cart-item__name"><?= htmlspecialchars($item['name']) ?></p>
                        <?php if (!empty($item['cake_wording'])): ?>
                            <p class="cart-item__wording">"<?= htmlspecialchars($item['cake_wording']) ?>"</p>
                        <?php endif; ?>
                        <p class="cart-item__price"><?= cart_format_rupiah($item['price']) ?></p>

                        <div class="cart-item__controls">
                            <!-- Kurangi qty -->
                            <form method="POST" action="<?= $root ?>cart-action.php" style="display:inline">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="qty" value="<?= $item['qty'] - 1 ?>">
                                <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                                <button type="submit" class="cart-item__qty-btn">−</button>
                            </form>

                            <span class="cart-item__qty"><?= $item['qty'] ?></span>

                            <!-- Tambah qty -->
                            <form method="POST" action="<?= $root ?>cart-action.php" style="display:inline">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="qty" value="<?= $item['qty'] + 1 ?>">
                                <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                                <button type="submit" class="cart-item__qty-btn">+</button>
                            </form>

                            <!-- Hapus item -->
                            <form method="POST" action="<?= $root ?>cart-action.php" style="display:inline">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
                                <button type="submit" class="cart-item__remove">Hapus</button>
                            </form>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <?php if (!empty($items)): ?>
    <div class="cart-drawer__footer">
        <div class="cart-drawer__total">
            <span>Total</span>
            <strong><?= cart_format_rupiah($total) ?></strong>
        </div>
        <a href="<?= $root ?>page/checkout/checkout.php" class="cart-drawer__checkout">
            Checkout →
        </a>
        <form method="POST" action="<?= $root ?>cart-action.php">
            <input type="hidden" name="action" value="clear">
            <button type="submit" class="cart-drawer__clear">Kosongkan keranjang</button>
        </form>
    </div>
    <?php endif; ?>

</aside>

<script>
function toggleCart() {
    const drawer  = document.getElementById('cartDrawer');
    const overlay = document.getElementById('cartOverlay');
    drawer.classList.toggle('open');
    overlay.classList.toggle('open');
    document.body.classList.toggle('cart-open');
}
</script>

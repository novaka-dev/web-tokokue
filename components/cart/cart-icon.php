<?php
/**
 * components/cart/cart-icon.php
 * Icon keranjang dengan badge jumlah item
 * Klik → masuk ke halaman cart.php
 * Tanpa JS, tanpa drawer
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../cart/cart.php';

$count = cart_count();
$root  = '/web-tokokue/';
?>

<a href="<?= $root ?>page/cart/cart.php" class="cart-icon" aria-label="Keranjang">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 01-8 0"/>
    </svg>
    <?php if ($count > 0): ?>
        <span class="cart-icon__badge"><?= $count ?></span>
    <?php endif; ?>
</a>

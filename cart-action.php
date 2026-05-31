<?php
/**
 * cart-action.php
 * Handle semua aksi keranjang via POST form
 * Taruh di ROOT project
 */

require_once __DIR__ . '/components/cart/cart.php';
require_once __DIR__ . '/data/products.php';

/** @var array $products */

$action   = $_POST['action']   ?? '';
$id       = (int) ($_POST['id']  ?? 0);
$qty      = (int) ($_POST['qty'] ?? 1);
$wording  = htmlspecialchars($_POST['cake_wording'] ?? '');
$redirect = $_POST['redirect']  ?? 'index.php';

switch ($action) {
    case 'add':
        // Cari produk berdasarkan id
        $product = null;
        foreach ($products as $p) {
            if ($p['id'] === $id) {
                $product = $p;
                break;
            }
        }
        if ($product) {
            cart_add($product, max(1, $qty), $wording);
        }
        break;

    case 'update':
        cart_update($id, $qty);
        $redirect = $_POST['redirect'] ?? '/web-tokokue/index.php';
        break;

    case 'remove':
        cart_remove($id);
        $redirect = $_POST['redirect'] ?? '/web-tokokue/index.php';
        break;

    case 'clear':
        cart_clear();
        $redirect = $_POST['redirect'] ?? '/web-tokokue/index.php';
        break;
}

header('Location: ' . $redirect);
exit;

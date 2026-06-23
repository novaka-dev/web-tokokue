<?php
/**
 * components/cart/cart.php
 * Keranjang belanja berbasis PHP Session
 * Tidak butuh database, tidak butuh JS
 */

// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// Inisialisasi keranjang kalau belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/**
 * Tambah produk ke keranjang
 */
function cart_add(array $product, int $qty = 1, string $cake_wording = ''): void {
    $id = (int) $product['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $qty;
    } else {
        $_SESSION['cart'][$id] = [
            'id'           => $id,
            'name'         => $product['name'],
            'price'        => $product['price'],
            'image'        => $product['image'],
            'qty'          => $qty,
            'cake_wording' => $cake_wording,
        ];
    }
}

/**
 * Update qty produk di keranjang
 */
function cart_update(int $id, int $qty): void {
    if ($qty <= 0) {
        cart_remove($id);
        return;
    }
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] = $qty;
    }
}

/**
 * Hapus produk dari keranjang
 */
function cart_remove(int $id): void {
    unset($_SESSION['cart'][$id]);
}

/**
 * Kosongkan keranjang
 */
function cart_clear(): void {
    $_SESSION['cart'] = [];
}

/**
 * Ambil semua item di keranjang
 */
function cart_items(): array {
    return $_SESSION['cart'] ?? [];
}

/**
 * Total harga semua item
 */
function cart_total(): int {
    $total = 0;
    foreach (cart_items() as $item) {
        $total += $item['price'] * $item['qty'];
    }
    return $total;
}

/**
 * Total jumlah item (untuk badge di icon keranjang)
 */
function cart_count(): int {
    $count = 0;
    foreach (cart_items() as $item) {
        $count += $item['qty'];
    }
    return $count;
}

/**
 * Format rupiah
 */
function cart_format_rupiah(int $amount): string {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

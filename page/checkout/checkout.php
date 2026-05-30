<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — Ann's Bakery</title>
    <link rel="stylesheet" href="../../assets/styles/main.css">
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once '../../components/cart/cart.php';
require_once '../../config.php';

$items = cart_items();
$total = cart_total();

// Redirect kalau keranjang kosong
if (empty($items)) {
    header('Location: ../../index.php');
    exit;
}

// Handle submit order → redirect ke WA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $nama    = htmlspecialchars(trim($_POST['nama']    ?? ''));
    $alamat  = htmlspecialchars(trim($_POST['alamat']  ?? ''));
    $catatan = htmlspecialchars(trim($_POST['catatan'] ?? ''));

    // Susun pesan WA
    $pesan  = "Halo Ann's Bakery, saya ingin memesan:%0A%0A";
    $pesan .= "*Nama:* $nama%0A";
    $pesan .= "*Alamat:* $alamat%0A";
    if ($catatan) $pesan .= "*Catatan:* $catatan%0A";
    $pesan .= "%0A*Detail Pesanan:*%0A";

    foreach ($items as $item) {
        $subtotal = cart_format_rupiah($item['price'] * $item['qty']);
        $pesan   .= "- {$item['name']} x{$item['qty']} = $subtotal%0A";
        if (!empty($item['cake_wording'])) {
            $pesan .= "  _(Tulisan kue: {$item['cake_wording']})_%0A";
        }
    }

    $pesan .= "%0A*Total: " . cart_format_rupiah($total) . "*%0A";
    $pesan .= "%0ATerima kasih!";

    $wa_url = 'https://wa.me/' . WA_NUMBER . '?text=' . $pesan;

    // Kosongkan keranjang setelah order
    cart_clear();

    header('Location: ' . $wa_url);
    exit;
}
?>

<main class="container checkout-page">

    <nav class="breadcrumb">
        <a href="../../index.php">Semua Produk</a>
        <span>/</span>
        <span>Checkout</span>
    </nav>

    <h1 class="checkout-page__title">Checkout</h1>

    <div class="checkout-layout">

        <!-- Struk / Ringkasan Pesanan -->
        <section class="checkout-struk">
            <h2 class="checkout-struk__title">Ringkasan Pesanan</h2>

            <ul class="checkout-struk__list">
                <?php foreach ($items as $item): ?>
                <li class="checkout-struk__item">
                    <img
                        src="<?= '/' . FOLDER_NAME . '/' . htmlspecialchars($item['image']) ?>"
                        alt="<?= htmlspecialchars($item['name']) ?>"
                        class="checkout-struk__img"
                    >
                    <div class="checkout-struk__detail">
                        <p class="checkout-struk__name"><?= htmlspecialchars($item['name']) ?></p>
                        <?php if (!empty($item['cake_wording'])): ?>
                            <p class="checkout-struk__wording">"<?= htmlspecialchars($item['cake_wording']) ?>"</p>
                        <?php endif; ?>
                        <p class="checkout-struk__qty">Qty: <?= $item['qty'] ?></p>
                    </div>
                    <p class="checkout-struk__subtotal">
                        <?= cart_format_rupiah($item['price'] * $item['qty']) ?>
                    </p>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="checkout-struk__divider"></div>

            <div class="checkout-struk__total">
                <span>Total Pembayaran</span>
                <strong><?= cart_format_rupiah($total) ?></strong>
            </div>

            <p class="checkout-struk__note">
                * Pembayaran dilakukan via konfirmasi WhatsApp
            </p>
        </section>

        <!-- Form Data Pembeli -->
        <section class="checkout-form-wrap">
            <h2 class="checkout-form__title">Data Pemesan</h2>

            <form method="POST" class="checkout-form">
                <div class="checkout-form__field">
                    <label for="nama">Nama Lengkap <span>*</span></label>
                    <input type="text" id="nama" name="nama" required placeholder="Contoh: Budi Santoso">
                </div>

                <div class="checkout-form__field">
                    <label for="alamat">Alamat Pengiriman <span>*</span></label>
                    <textarea id="alamat" name="alamat" required rows="3" placeholder="Jl. Contoh No. 1, Kota, Provinsi"></textarea>
                </div>

                <div class="checkout-form__field">
                    <label for="catatan">Catatan Tambahan</label>
                    <textarea id="catatan" name="catatan" rows="2" placeholder="Opsional — waktu pengiriman, instruksi khusus, dll"></textarea>
                </div>

                <button type="submit" name="checkout" class="checkout-form__submit">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                        <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                    </svg>
                    Pesan via WhatsApp
                </button>
            </form>
        </section>

    </div>

</main>

</body>
</html>

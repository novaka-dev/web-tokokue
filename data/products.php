<?php
/**
 * data/products.php
 * Data dummy produk Ann's Bakery
 * PATH GAMBAR RELATIF (tanpa BASE_URL)
 */

// Cek apakah BASE_URL sudah didefinisikan (fallback)
if (!defined('BASE_URL')) {
    // Fallback jika config.php tidak di-include
    define('BASE_URL', '/web-tokokue/');
}

$products = [
    [
        'id'    => 1,
        'name'  => "Ann's Assorté",
        'price' => 590000,
        'image' => 'assets/images/products/1.webp',
        'images' => [
            'assets/images/products/1.webp',
            'assets/images/products/1.webp',

        ],
        'badge' => 'Best Seller',
        'cake_wording' => true,
        'details' => "Assorted cake box premium dengan berbagai pilihan rasa terbaik dari Ann's Bakery. Cocok untuk hadiah dan acara spesial.",
        'storage_care' => "Simpan dalam lemari pendingin (2–8°C) dan konsumsi dalam 3 hari untuk kualitas terbaik.",
    ],
    [
        'id'    => 2,
        'name'  => "Ann's Petits Fours Special",
        'price' => 595000,
        'image' => 'assets/images/products/2.jpg',
        'images' => [
            'assets/images/products/2.jpg',
        ],
        'badge' => "Best Seller",
        'cake_wording' => false,
        'details' => "Koleksi petit fours eksklusif dengan 12 varian rasa yang menggugah selera. Sajian elegan untuk segala acara.",
        'storage_care' => "Simpan di tempat sejuk dan kering, hindari sinar matahari langsung.",
    ],
    [
        'id'    => 3,
        'name'  => 'Fruit Cake',
        'price' => 580000,
        'image' => 'assets/images/products/3.webp',
        'images' => [
            'assets/images/products/3.webp',
        ],
        'badge' => 'Best Seller',
        'cake_wording' => true,
        'details' => "Fruit Cake Ann's menggunakan sponge vanilla lembut dengan topping buah-buahan segar pilihan. Perpaduan sempurna antara manis dan segar.",
        'storage_care' => "Simpan dalam kulkas (2–8°C) dan konsumsi dalam 2-3 hari.",
    ],
    [
        'id'    => 4,
        'name'  => 'Corn Cheese Tres Leches',
        'price' => 426000,
        'image' => 'assets/images/products/4.webp',
        'images' => [
            'assets/images/products/4.webp',
        ],
        'badge' => 'New',
        'cake_wording' => true,
        'details' => "Inovasi unik Ann's yang memadukan kelembutan tres leches dengan gurihnya jagung dan keju. Sensasi rasa yang tak terlupakan.",
        'storage_care' => "Simpan dalam kulkas (2–8°C) dan konsumsi dalam 2 hari.",
    ],
    [
        'id'    => 5,
        'name'  => 'Tiramisu Cake',
        'price' => 520000,
        'image' => 'assets/images/products/5.png',
        'images' => [
            'assets/images/products/5.png',
        ],
        'badge' => "Best Seller",
        'cake_wording' => true,
        'details' => "Tiramisu klasik Ann's versi whole cake dengan lapisan mascarpone creamy dan bubuk coklat premium. Autentik Italia di setiap gigitan.",
        'storage_care' => "Simpan dalam kulkas (2–8°C) dan konsumsi dalam 2-3 hari.",
    ],
    [
        'id'    => 6,
        'name'  => 'Jakarta Cheesecake',
        'price' => 475000,
        'image' => 'assets/images/products/jc.jpg',
        'images' => [
            'assets/images/products/jc.jpg',
        ],
        'badge' => 'New',
        'cake_wording' => true,
        'details' => "Perpaduan harmonis antara sponge matcha Uji premium dengan cream cheese yang lembut. Sentuhan modern dengan cita rasa lokal.",
        'storage_care' => "Simpan dalam kulkas (2–8°C) dan konsumsi dalam 2-3 hari.",
    ],
    [
        'id'    => 7,
        'name'  => 'Classic Black Forest',
        'price' => 450000,
        'image' => 'assets/images/products/bf.jpg',
        'images' => [
            'assets/images/products/bf.jpg',
        ],
        'badge' => null,
        'cake_wording' => true,
        'details' => "Black Forest klasik Ann's menggunakan chocolate sponge dengan lapisan cherry dan whipped cream. Kelezatan yang tak pernah lekang oleh waktu.",
        'storage_care' => "Simpan dalam kulkas (2–8°C) dan konsumsi dalam 2-3 hari.",
    ],
    [
        'id'    => 8,
        'name'  => 'Tres Leches Montblanc',
        'price' => 510000,
        'image' => 'assets/images/products/tlm.webp',
        'images' => [
            'assets/images/products/tlm.webp',
        ],
        'badge' => 'Seasonal',
        'cake_wording' => false,
        'details' => "Cheesecake premium dengan topping mangga harum musim dan tres leches yang lembut. Kombinasi tropis yang menyegarkan.",
        'storage_care' => "Simpan dalam kulkas (2–8°C) dan konsumsi dalam 2 hari.",
    ],
];
?>

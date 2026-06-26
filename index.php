<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="assets/styles/main.css">
</head>

<body>
  <?php
  include "components/navbar/navbar.php";
  include 'components/header/header.php';
  ?>
	<div class="content">
	  <div class="container">
	  <?php
	    require_once 'components/product-card/product-card.php';
	    require_once 'data/products.php';

	    // Filter hanya produk Best Seller untuk ditampilkan di homepage
	    $best_sellers = array_filter($products, function($p) {
	        return isset($p['badge']) && strtolower($p['badge']) === 'best seller';
	    });
	  ?>

	  <div class="section-heading">
	      <p class="section-heading__label">Pilihan Terbaik Kami</p>
	      <h2 class="section-heading__title">Best Sellers</h2>
	      <p class="section-heading__desc">Produk-produk paling dicintai pelanggan Ann's Bakery, hadir untuk melengkapi momen istimewamu.</p>
	  </div>

	  <?php
	    render_product_grid($best_sellers);
	  ?>

	  <div class="section-heading__cta">
	      <a href="/web-tokokue/page/shop/shop.php" class="section-heading__btn">Lihat Semua Produk →</a>
	  </div>

	  </div>
	</div>
  <div class="container" id="bout">
  <?php
    include 'components/aboutus/aboutus.php';
  ?>
  </div>
  <?php 
  include 'components/footer/footer.php';
  ?>
</body>
</html>

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

	    render_product_grid($products);
	  ?>
	  </div>
	</div>
  <div class="container">
  <?php
    include 'components/aboutus/aboutus.php';
  ?>
  </div>
</body>
</html>

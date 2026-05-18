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
    include 'components/header/header.php';
  ?>

  <?php
    include 'components/aboutus/aboutus.php';
  ?>

  <?php
    require_once 'components/product-card/product-card.php';  // komponen
    require_once 'data/products.php';            // data dummy

    render_product_grid($products);
    ?>

</body>
</html>

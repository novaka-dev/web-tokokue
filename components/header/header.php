<!-- header.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Luxury Cake</title>

  <!-- CSS -->
  <link rel="stylesheet" href="header.css">
  <?php
  if (session_status() === PHP_SESSION_NONE) session_start();
  require_once $_SERVER['DOCUMENT_ROOT'] . '/web-tokokue/components/cart/cart-icon.php';
  ?>
</head>

<body>

  <!-- header.php -->
<header>
  <div class="hero">
    <h1>Start It With Cake</h1>
    <h2>A Thoughtful Way to Celebrate.</h2>
    <p>#AssortéCreations</p>
    <a href="/web-tokokue/page/shop/shop.php" class="btn-shop">Shop Now</a>
  </div>
</header>

</body>
</html>

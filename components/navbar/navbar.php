<nav class="nav-utama">
	<button class="burger" type="button" command="open-popover" popovertarget="navbar-dialog">
	  <div class="bar1"></div>
	  <div class="bar2"></div>
	  <div class="bar3"></div>
	</button>
	<div class="navbar-dialog" popover id="navbar-dialog">
		<aside class="navbar-sidebar" id="navbar-sidebar" >
			<button class="burger" type="button" command="close-popover" popovertarget="navbar-dialog" style="position: absolute; right: 0;">
	  			<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#AB9164" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
			</button>
<!-- <<<<<<< Updated upstream -->
      <!-- Menu navigasi -->
            <nav class="sidebar-nav">
                <ul class="sidebar-nav__list">
                    <li><a href="/web-tokokue/" class="sidebar-nav__link">Home</a></li>
                    <li><a href="/web-tokokue/page/shop/shop.php" class="sidebar-nav__link">Shop</a></li>
                    <li><a href="/web-tokokue/components/aboutus/aboutus.php" class="sidebar-nav__link">About Us</a></li>
                    <li><a href="/web-tokokue/#contact" class="sidebar-nav__link">Contact</a></li>
                    <li><a href="/web-tokokue/page/cart/cart.php" class="sidebar-nav__link">Keranjang</a></li>
                </ul>
            </nav>
		</aside>
	</div>
  <?php
  $BASE_URL = "/web-tokokue";
  ?>
	<a class="brand-link" href="<?php echo $BASE_URL; ?>">
    <img class="brand-logo" src="<?php echo $BASE_URL; ?>/assets/images/anns.png" alt="anns">
  </a>
	<div class="menu-right">
		<a class="sign" href="<?php echo $BASE_URL; ?>/auth/login.php">Sign in</a>
		<button type="button" class="search-button">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#AB9164" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
		</button>
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/web-tokokue/components/cart/cart-icon.php'; ?>
	</div>
</nav>

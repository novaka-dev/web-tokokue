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
                    <li><a href="/web-tokokue/#shop" class="sidebar-nav__link">Shop</a></li>
                    <li><a href="/web-tokokue/#about" class="sidebar-nav__link">About Us</a></li>
                    <li><a href="/web-tokokue/#contact" class="sidebar-nav__link">Contact</a></li>
                    <li><a href="/web-tokokue/page/cart/cart.php" class="sidebar-nav__link">Keranjang</a></li>
                </ul>
            </nav>
<!-- ======= -->
			<!-- <div class="sidebarlink">
				<a href="#" class="sidebarlink-item">
					Home
				</a>
				<div class="sidebarlink-item sidebar-drop">
					<div class="sidebarlink-item-head shop-container">
						Shop
						<svg xmlns="http://www.w3.org/2000/svg" width="0.7em" height="0.7em" viewBox="0 0 40 40">
							<path d="M0 0h40v40H0z" fill="none" />
							<path fill="currentColor" d="M4.659 11.833h30.682L20 32.167z" />
						</svg>
					</div>
					<input class="toggle-sublink" type="checkbox" name="checkbox" id="checkbox">
					<div class="sidebarlink-sublink">
						<a href="#" class="sublink">New Creations</a>
						<a href="#" class="sublink">Classic Creations</a>
						<a href="#" class="sublink">Signature Creations</a>
						<a href="#" class="sublink">Elevated Signature</a>
						<a href="#" class="sublink">Super Creations</a>
						<a href="#" class="sublink">Cookies Creations</a>
						<a href="#" class="sublink">Pastry Creations</a>
					</div>
				</div>

				<div class="sidebarlink-item sidebar-drop">
					<div class="sidebarlink-item-head shop-container">
						About
						<svg xmlns="http://www.w3.org/2000/svg" width="0.7em" height="0.7em" viewBox="0 0 40 40">
							<path d="M0 0h40v40H0z" fill="none" />
							<path fill="currentColor" d="M4.659 11.833h30.682L20 32.167z" />
						</svg>
					</div>
					<input class="toggle-sublink" type="checkbox" name="checkbox" id="checkbox">
					<div class="sidebarlink-sublink">
						<a href="#" class="sublink">Membership</a>
						<a href="#" class="sublink">Terms & Conditions</a>
						<a href="#" class="sublink">Ann's Career</a>
						<a href="#" class="sublink">About us</a>
						<a href="#" class="sublink">Our Stores</a>
						<a href="#" class="sublink">Shipping & Delivery</a>
						<a href="#" class="sublink">FAQ & Help</a>
					</div>
				</div>
			</div> -->
<!-- >>>>>>> Stashed changes -->
		</aside>
	</div>
  <?php
  $BASE_URL = "/web-tokokue";
  ?>
	<a class="brand-link" href="<?php echo $BASE_URL; ?>">
    <img class="brand-logo" src="<?php echo $BASE_URL; ?>/assets/images/anns.png" alt="anns">
  </a>
	<div class="menu-right">
		<a class="sign" href="#">Sign in</a>
		<button type="button" class="search-button">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#AB9164" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
		</button>
		<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/components/cart/cart-icon.php'; ?>
		<?php
		// require_once $_SERVER['DOCUMENT_ROOT'] . '/web-tokokue/components/cart/cart-icon.php'; 
		?>
	</div>
</nav>

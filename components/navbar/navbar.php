<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="nav-utama">
    <button class="burger" type="button">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <input id="rad1" type="radio" class="but-open" name="openclose">
    </button>
    
    
    <div class="navbar-dialog" id="navbar-dialog">
        <aside class="navbar-sidebar" id="navbar-sidebar">
            <button class="burger" type="button" style="position: absolute; right: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#AB9164" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                <input id="rad2" type="radio" class="but-open" name="openclose">
            </button>
            
            <nav class="sidebar-nav">
                <ul class="sidebar-nav__list">
                    <li><a href="/web-tokokue/" class="sidebar-nav__link">Home</a></li>
                    <li><a href="/web-tokokue/page/shop/shop.php" class="sidebar-nav__link">Shop</a></li>
                    <li><a href="/web-tokokue/index.php#bout" class="sidebar-nav__link">About Us</a></li>
                    <li><a href="/web-tokokue/#contact" class="sidebar-nav__link">Contact</a></li>
                    <li><a href="/web-tokokue/page/cart/cart.php" class="sidebar-nav__link">Keranjang</a></li>
                    
                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                        <li style="border-top: 1px solid #f0ece6; margin-top: 10px; padding-top: 16px;">
                            <a href="/web-tokokue/auth/logout.php" class="sidebar-nav__link" style="color:#b5832a; font-weight:600;">
                                🚪 Logout (<?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>)
                            </a>
                        </li>
                    <?php endif; ?>
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
        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
            <span style="font-size:0.9rem; color:#ab9164; margin-right:10px;">
                👋 <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>
            </span>
            <a class="sign" href="/web-tokokue/auth/logout.php" 
               style="color:#b5832a; border:1.5px solid #b5832a; border-radius:999px; padding:0.3rem 1rem; transition:all 0.3s ease;"
               onmouseover="this.style.backgroundColor='#b5832a'; this.style.color='white';"
               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#b5832a';">
                Logout
            </a>
        <?php else: ?>
            <a class="sign" href="/web-tokokue/auth/login.php">Sign in</a>
        <?php endif; ?>
        
        <button type="button" class="search-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#AB9164" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
        </button>
        
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/web-tokokue/components/cart/cart-icon.php'; ?>
    </div>
</nav>
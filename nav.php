<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("topscript.php"); 
?>
<nav class="client-navbar">
    <div class="navbar-container">
        <a href="chome.php" class="navbar-logo">
            <i class="bi bi-controller" style="color: var(--theme-primary);"></i> GAME<span>KART</span>
        </a>
        <ul class="navbar-links">
            <li class="nav-item"><a href="chome.php"><i class="bi bi-house me-1"></i>Home</a></li>
            <li class="nav-item"><a href="cviewproduct.php"><i class="bi bi-grid me-1"></i>Products</a></li>
            <li class="nav-item"><a href="cart.php"><i class="bi bi-cart3 me-1"></i>Cart</a></li>
            <li class="nav-item"><a href="orders.php"><i class="bi bi-bag-check me-1"></i>My Orders</a></li>
            <li class="nav-item"><a href="ccontact.php"><i class="bi bi-headset me-1"></i>Support</a></li>
        </ul>
        <div class="nav-actions">
            <?php if (isset($_SESSION['uname']) && !empty($_SESSION['uname'])): ?>
                <span class="badge badge-purple">
                    <i class="bi bi-person-fill me-1"></i><?php echo htmlspecialchars($_SESSION['uname']); ?>
                </span>
                <a href="logout.php" class="btn-secondary" style="padding: 7px 14px; font-size: 13px;">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </a>
            <?php else: ?>
                <a href="clogin.php" class="btn-secondary" style="padding: 7px 16px;">Login</a>
                <a href="cregister.php" class="btn-primary" style="padding: 7px 18px;">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php
// Check if user is logged in for conditional navigation display
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<nav class="navbar">
    <div class="container navbar-container">
        <div class="navbar-brand">
            <a href="<?php echo $is_logged_in ? 'index.php' : 'login.php'; ?>" class="navbar-logo">
                Bedazzle <span class="sparkle">✨</span>
            </a>
        </div>
        
        <div class="navbar-menu">
            <ul class="navbar-items">
                <?php if ($is_logged_in): ?>
                    <li><a href="index.php" class="navbar-item">Home</a></li>
                    <li><a href="products_page.php" class="navbar-item">Products</a></li>
                    <li><a href="cart.php" class="navbar-item">Cart 🛍️</a></li>
                    <li><a href="logout.php" class="navbar-item btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="navbar-item">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav> 
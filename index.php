<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Bedazzle ✨</title>
    <link rel="stylesheet" href="includes/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="welcome-section">
            <h1 class="welcome-title">Welcome to Bedazzle</h1>
            <p>Hello <?php echo htmlspecialchars($_SESSION['username'] ?? 'Lovely User'); ?> <span class="sparkle-fast">✨</span></p>
            <p>We're so happy to have you here in our magical space <span class="sparkle-slow">✨</span></p>
        </div>
        
        <?php include 'includes/product_listing.php'; ?>
    </div>
</body>
</html> 
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
    <title>Our Products ✨ Bedazzle</title>
    <link rel="stylesheet" href="includes/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container">
        <div class="welcome-section">
            <h1 class="welcome-title">Our Magical Collection</h1>
            <p>Discover our enchanting selection of products <span class="sparkle-slow">✨</span></p>
        </div>
        
        <?php include 'includes/product_listing.php'; ?>
    </div>
</body>
</html> 
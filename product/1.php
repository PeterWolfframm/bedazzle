<?php
session_start();
require_once '../includes/Products.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

$products = new Products();
$product_id = basename(__FILE__, '.php'); // Gets '1' from '1.php'
$product = $products->getProductById((int)$product_id);

if (!$product) {
    header('Location: ../index.php');
    exit;
}

// Get rating and review count
$rating = $products->getProductRating($product_id);
$reviews_count = $products->getProductReviewCount($product_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> ✨ Bedazzle</title>
    <link rel="stylesheet" href="../includes/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    
    <div class="container">
        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['picture']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="product-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <div class="product-meta">
                    <div class="price">€<?php echo number_format($product['price'], 2); ?></div>
                    <div class="rating">
                        <?php echo number_format($rating, 1); ?> ★ (<?php echo $reviews_count; ?> reviews)
                    </div>
                </div>
                <form action="../cart/add.php" method="POST" class="add-to-cart">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn">Add to Cart ✨</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 
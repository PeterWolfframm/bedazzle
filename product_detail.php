<?php
session_start();
require_once "includes/Products.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$productsManager = new Products();
$product = $productsManager->getProductById($product_id);

if (!$product) {
    header('Location: products.php');
    exit;
}

$rating = $productsManager->getProductRating($product_id);
$reviews_count = $productsManager->getProductReviewCount($product_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> ✨ Bedazzle</title>
    <link rel="stylesheet" href="includes/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container">
        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['picture']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="product-info">
                <h1 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <div class="product-meta">
                    <div class="price">€<?php echo number_format($product['price'], 2); ?></div>
                    <div class="rating">
                        <div class="stars">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '★';
                                } else {
                                    echo '☆';
                                }
                            }
                            ?>
                        </div>
                        <span class="rating-count">(<?php echo $reviews_count; ?> reviews)</span>
                    </div>
                </div>
                <form action="cart/add.php" method="POST" class="add-to-cart-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="add-to-cart-btn">Add to Cart ✨</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 
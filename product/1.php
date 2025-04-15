<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

// noch hartgecoded
$product = [
    'id' => 1,
    'name' => 'Pearl Hair Bow',
    'description' => 'Delicate satin bow with pearl embellishments, perfect for a dreamy look. This exquisite hair accessory features hand-sewn pearls and premium satin fabric, creating an ethereal and romantic accent for any hairstyle. Perfect for special occasions or adding a touch of elegance to your everyday look.',
    'price' => 19.99,
    'picture' => 'https://plus.unsplash.com/premium_photo-1709033404514-c3953af680b4?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
    'rating' => 4.8,
    'reviews_count' => 124,
    'in_stock' => true
];
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

    <div class="product-section">
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['picture']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="product-details">
                <h1 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="product-rating">
                    <span class="stars">
                        <?php
                        $rating = $product['rating'];
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo '★';
                            } else {
                                echo '☆';
                            }
                        }
                        ?>
                    </span>
                    <span class="review-count"><?php echo $product['reviews_count']; ?> reviews</span>
                </div>
                <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                
                <div class="stock-status <?php echo !$product['in_stock'] ? 'out-of-stock' : ''; ?>">
                    <?php echo $product['in_stock'] ? '✨ In Stock' : '🌙 Out of Stock'; ?>
                </div>

                <button class="add-to-cart-btn" onclick="addToCart(<?php echo $product['id']; ?>)">
                    Add to Cart 🛍️
                </button>
                <button class="wishlist-btn">
                    Add to Wishlist 💖
                </button>

                <div class="product-features">
                    <div class="feature-item">
                        <span class="feature-icon">🎀</span>
                        <span>Premium satin fabric</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">✨</span>
                        <span>Hand-sewn pearl embellishments</span>
                    </div>
                    <div class="feature-item">
                        <span class="feature-icon">🌸</span>
                        <span>Perfect for all hair types</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function addToCart(productId) {
        // TODO: Implement cart functionality
        alert('Product will be added to cart soon!');
    }
    </script>
</body>
</html> 
<?php
require_once 'Products.php';

$productsManager = new Products();
$products = $productsManager->getAllProducts();
?>

<div class="product-section">
    <h2 class="section-title">✨ Our Magical Collection ✨</h2>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <a href="product_detail.php?id=<?php echo $product['id']; ?>" class="product-link">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($product['picture']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="product-details">
                            <span class="price">$<?php echo number_format($product['price'], 2); ?></span>
                            <div class="rating">
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
                                <span class="rating-value">(<?php echo $product['rating']; ?>)</span>
                            </div>
                        </div>
                        <button class="add-to-cart" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart 🛍️</button>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.product-section {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.section-title {
    text-align: center;
    margin-bottom: 2rem;
    color: #333;
    font-size: 2rem;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
}

.product-card {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.2s;
    background: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.product-image img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.product-info {
    padding: 1rem;
}

.product-info h3 {
    margin: 0 0 0.5rem 0;
    color: #333;
}

.product-description {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 1rem;
}

.product-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #2c3e50;
}

.rating {
    display: flex;
    align-items: center;
}

.stars {
    color: #ffd700;
    margin-right: 0.5rem;
}

.rating-value {
    color: #666;
    font-size: 0.9rem;
}

.add-to-cart {
    width: 100%;
    padding: 0.8rem;
    background: #ff69b4;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.2s;
}

.add-to-cart:hover {
    background: #ff1493;
}
</style>


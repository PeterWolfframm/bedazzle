<?php
// Beispieldaten
$products = [
    [
        'id' => 1,
        'name' => 'Pearl Hair Bow',
        'description' => 'Delicate satin bow with pearl embellishments, perfect for a dreamy look',
        'price' => 19.99,
        'picture' => 'images/pearl-bow.jpg',
        'category_id' => 1,
        'rating' => 4.8
    ],
    [
        'id' => 2,
        'name' => 'Crystal Heart Necklace',
        'description' => 'Dainty heart-shaped crystal pendant on a delicate silver chain',
        'price' => 24.99,
        'picture' => 'images/heart-necklace.jpg',
        'category_id' => 2,
        'rating' => 4.9
    ],
    [
        'id' => 3,
        'name' => 'Lace Ribbon Choker',
        'description' => 'Soft pink lace choker with ribbon ties and crystal charm',
        'price' => 15.99,
        'picture' => 'images/lace-choker.jpg',
        'category_id' => 2,
        'rating' => 4.7
    ],
    [
        'id' => 4,
        'name' => 'Butterfly Hair Clips Set',
        'description' => 'Set of 6 sparkly butterfly clips in pastel colors',
        'price' => 12.99,
        'picture' => 'images/butterfly-clips.jpg',
        'category_id' => 1,
        'rating' => 4.6
    ],
    [
        'id' => 5,
        'name' => 'Pearl Beaded Bracelet',
        'description' => 'Elastic bracelet with mixed-size pearls and crystal spacers',
        'price' => 18.99,
        'picture' => 'images/pearl-bracelet.jpg',
        'category_id' => 2,
        'rating' => 4.8
    ],
    [
        'id' => 6,
        'name' => 'Glitter Heart Purse',
        'description' => 'Small heart-shaped purse with iridescent glitter finish',
        'price' => 29.99,
        'picture' => 'images/heart-purse.jpg',
        'category_id' => 3,
        'rating' => 4.9
    ]
];
?>

<div class="product-section">
    <h2 class="section-title">✨ Our Magical Collection ✨</h2>
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo htmlspecialchars($product['picture']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="product-details">
                        <span class="price">$<?php echo number_format($product['price'], 2); ?></span>
                 
                    </div>
                    <button class="add-to-cart" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart 🛍️</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


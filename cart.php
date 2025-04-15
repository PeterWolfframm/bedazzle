<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Beispieldaten
$cart_items = [
    [
        'id' => 1,
        'name' => 'Pearl Hair Bow',
        'price' => 19.99,
        'quantity' => 2,
        'picture' => 'images/pearl-bow.jpg'
    ],
    [
        'id' => 3,
        'name' => 'Lace Ribbon Choker',
        'price' => 15.99,
        'quantity' => 1,
        'picture' => 'images/lace-choker.jpg'
    ],
    [
        'id' => 6,
        'name' => 'Glitter Heart Purse',
        'price' => 29.99,
        'quantity' => 1,
        'picture' => 'images/heart-purse.jpg'
    ]
];

// Calculate totals
$subtotal = 0;
foreach ($cart_items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = 4.99;
$total = $subtotal + $shipping;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart ✨ Bedazzle</title>
    <link rel="stylesheet" href="includes/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .cart-section {
            padding: 2rem;
            background-color: #fff5f7;
            min-height: calc(100vh - 60px);
        }

        .cart-title {
            text-align: center;
            font-size: 2rem;
            color: #ff66b2;
            margin-bottom: 2rem;
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(255, 182, 193, 0.3);
        }

        .cart-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 2rem;
        }

        .cart-items {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.2);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #ffe6ee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            overflow: hidden;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .item-name {
            color: #ff4d94;
            font-family: 'Playfair Display', serif;
            margin-bottom: 0.5rem;
        }

        .item-price {
            color: #666;
            font-size: 0.9rem;
        }

        .item-quantity {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-btn {
            background: #ffe6ee;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            color: #ff66b2;
            cursor: pointer;
            font-size: 1rem;
            line-height: 1;
            transition: background-color 0.3s ease;
        }

        .quantity-btn:hover {
            background: #ff99cc;
            color: white;
        }

        .cart-summary {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            height: fit-content;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.2);
        }

        .summary-title {
            color: #ff4d94;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: #666;
        }

        .summary-total {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid #ffe6ee;
            font-weight: bold;
            color: #ff4d94;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 1rem;
            background-color: #ff99cc;
            color: white;
            border: none;
            border-radius: 25px;
            margin-top: 1.5rem;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
        }

        .checkout-btn:hover {
            background-color: #ff66b2;
        }

        .empty-cart {
            text-align: center;
            color: #666;
            padding: 2rem;
        }

        .continue-shopping {
            color: #ff66b2;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }

        .continue-shopping:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }

            .cart-item {
                grid-template-columns: 80px 1fr;
                grid-template-rows: auto auto;
            }

            .item-quantity {
                grid-column: 2;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="cart-section">
        <h1 class="cart-title">Your Magical Cart ✨</h1>
        
        <div class="cart-container">
            <div class="cart-items">
                <?php if (empty($cart_items)): ?>
                    <div class="empty-cart">
                        <p>Your cart is empty</p>
                        <a href="index.php" class="continue-shopping">Continue Shopping ✨</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="<?php echo htmlspecialchars($item['picture']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            </div>
                            <div class="item-details">
                                <h3 class="item-name"><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="item-price">$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                            <div class="item-quantity">
                                <button class="quantity-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, 'decrease')">-</button>
                                <span><?php echo $item['quantity']; ?></span>
                                <button class="quantity-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, 'increase')">+</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$<?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>$<?php echo number_format($shipping, 2); ?></span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
                <a href="#" class="checkout-btn">Proceed to Checkout 🎀</a>
            </div>
        </div>
    </div>

    <script>
    function updateQuantity(productId, action) {
        // TODO: Implement quantity update functionality
        alert('Quantity update will be implemented soon!');
    }
    </script>
</body>
</html> 
<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once 'includes/Cart.php';
$cart = new Cart();

// Handle AJAX requests for cart updates
if (isset($_POST['action']) && isset($_POST['product_id'])) {
    header('Content-Type: application/json');
    $productId = (int)$_POST['product_id'];
    
    switch ($_POST['action']) {
        case 'increase':
            foreach ($cart->getItems() as $item) {
                if ($item['id'] == $productId) {
                    $cart->updateQuantity($productId, $item['quantity'] + 1);
                    break;
                }
            }
            break;
            
        case 'decrease':
            foreach ($cart->getItems() as $item) {
                if ($item['id'] == $productId) {
                    $cart->updateQuantity($productId, $item['quantity'] - 1);
                    break;
                }
            }
            break;
    }
    
    echo json_encode([
        'success' => true,
        'subtotal' => number_format($cart->getSubtotal(), 2),
        'shipping' => number_format($cart->getShipping(), 2),
        'total' => number_format($cart->getTotal(), 2)
    ]);
    exit;
}

$cart_items = $cart->getItems();
$subtotal = $cart->getSubtotal();
$shipping = $cart->getShipping();
$total = $cart->getTotal();
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
                <?php if ($cart->isEmpty()): ?>
                    <div class="empty-cart">
                        <p>Your cart is empty</p>
                        <a href="index.php" class="continue-shopping">Continue Shopping ✨</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart-item" data-product-id="<?php echo $item['id']; ?>">
                            <div class="item-image">
                                <img src="<?php echo htmlspecialchars($item['picture']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            </div>
                            <div class="item-details">
                                <h3 class="item-name"><?php echo htmlspecialchars($item['name']); ?></h3>
                                <p class="item-price">$<?php echo number_format($item['price'], 2); ?></p>
                            </div>
                            <div class="item-quantity">
                                <button class="quantity-btn decrease-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, 'decrease')">-</button>
                                <span class="quantity-value"><?php echo $item['quantity']; ?></span>
                                <button class="quantity-btn increase-btn" onclick="updateQuantity(<?php echo $item['id']; ?>, 'increase')">+</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span class="subtotal">$<?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span class="shipping">$<?php echo number_format($shipping, 2); ?></span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span class="total">$<?php echo number_format($total, 2); ?></span>
                </div>
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout 🎀</a>
            </div>
        </div>
    </div>

    <script>
    function updateQuantity(productId, action) {
        fetch('cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=${action}&product_id=${productId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartItem = document.querySelector(`.cart-item[data-product-id="${productId}"]`);
                if (cartItem) {
                    const quantitySpan = cartItem.querySelector('.quantity-value');
                    const currentQuantity = parseInt(quantitySpan.textContent);
                    
                    if (action === 'increase') {
                        quantitySpan.textContent = currentQuantity + 1;
                    } else if (action === 'decrease') {
                        const newQuantity = currentQuantity - 1;
                        if (newQuantity <= 0) {
                            cartItem.remove();
                            if (document.querySelectorAll('.cart-item').length === 0) {
                                location.reload(); // Reload to show empty cart message
                            }
                        } else {
                            quantitySpan.textContent = newQuantity;
                        }
                    }
                    
                    // Update summary
                    document.querySelector('.subtotal').textContent = `$${data.subtotal}`;
                    document.querySelector('.shipping').textContent = `$${data.shipping}`;
                    document.querySelector('.total').textContent = `$${data.total}`;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the cart. Please try again.');
        });
    }
    </script>
</body>
</html> 
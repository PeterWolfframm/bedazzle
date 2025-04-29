<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

require_once '../includes/Cart.php';
require_once '../includes/Products.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = (int)$_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    // Get product details
    $productsManager = new Products();
    $product = $productsManager->getProductById($productId);
    
    if ($product) {
        // Add to cart
        $cart = new Cart();
        $cart->addItem(
            $productId,
            $product['name'],
            $product['price'],
            $product['picture'],
            $quantity
        );
        
        // Redirect back to product page with success message
        $_SESSION['message'] = 'Product added to cart successfully!';
        header('Location: ../product_detail.php?id=' . $productId);
        exit;
    }
}

// If we get here, something went wrong
$_SESSION['error'] = 'Failed to add product to cart.';
header('Location: ../products_page.php');
exit; 
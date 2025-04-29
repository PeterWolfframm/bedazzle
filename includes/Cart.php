<?php

class Cart {
    private $items = [];
    private $shipping = 4.99;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Initialize cart from session if it exists
        if (isset($_SESSION['cart'])) {
            $this->items = $_SESSION['cart'];
        }
    }

    public function addItem($productId, $name, $price, $picture, $quantity = 1) {
        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity'] += $quantity;
        } else {
            $this->items[$productId] = [
                'id' => $productId,
                'name' => $name,
                'price' => $price,
                'picture' => $picture,
                'quantity' => $quantity
            ];
        }
        $this->saveCart();
    }

    public function removeItem($productId) {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
            $this->saveCart();
        }
    }

    public function updateQuantity($productId, $quantity) {
        if (isset($this->items[$productId])) {
            if ($quantity <= 0) {
                $this->removeItem($productId);
            } else {
                $this->items[$productId]['quantity'] = $quantity;
                $this->saveCart();
            }
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function getSubtotal() {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal;
    }

    public function getShipping() {
        return empty($this->items) ? 0 : $this->shipping;
    }

    public function getTotal() {
        return $this->getSubtotal() + $this->getShipping();
    }

    public function clear() {
        $this->items = [];
        $this->saveCart();
    }

    public function isEmpty() {
        return empty($this->items);
    }

    private function saveCart() {
        $_SESSION['cart'] = $this->items;
    }
} 
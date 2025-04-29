<?php
require_once __DIR__ . '/../dbaccess.php';

class Products {
    private $db;

    public function __construct() {
        global $con;
        $this->db = $con;
    }

    public function getAllProducts() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {
            return [];
        }
    }

    public function getProductById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (mysqli_sql_exception $e) {
            return null;
        }
    }

    public function getProductsByCategory($category_id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = ?");
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {
            return [];
        }
    }

    public function getProductRating($product_id) {
        try {
            $stmt = $this->db->prepare("SELECT AVG(review) as avg_rating FROM reviews WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $rating = $result->fetch_assoc();
            return $rating['avg_rating'] ?? 0;
        } catch (mysqli_sql_exception $e) {
            return 0;
        }
    }

    public function getProductReviewCount($product_id) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as review_count FROM reviews WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $count = $result->fetch_assoc();
            return $count['review_count'] ?? 0;
        } catch (mysqli_sql_exception $e) {
            return 0;
        }
    }
} 
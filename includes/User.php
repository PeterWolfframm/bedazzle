<?php
require_once __DIR__ . '/../dbaccess.php';

class User {
    private $db;

    public function __construct() {
        global $con;
        $this->db = $con;
    }

    public function register($userData) {
        try {
            // Validate email
            if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'Invalid email format'];
            }

            // Check if email already exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $userData['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->fetch_assoc()) {
                return ['success' => false, 'message' => 'Email already registered'];
            }

            // Check if username already exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $userData['username']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->fetch_assoc()) {
                return ['success' => false, 'message' => 'Username already taken'];
            }

            // Validate password strength
            if (strlen($userData['password']) < 8) {
                return ['success' => false, 'message' => 'Password must be at least 8 characters long'];
            }

            // Hash password
            $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);

            // Insert new user
            $stmt = $this->db->prepare("
                INSERT INTO users (salutation, firstname, lastname, address, postalcode, city, email, username, password, payment_method, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'user')
            ");

            $stmt->bind_param("ssssssssss",
                $userData['salutation'],
                $userData['firstname'],
                $userData['lastname'],
                $userData['address'],
                $userData['postalcode'],
                $userData['city'],
                $userData['email'],
                $userData['username'],
                $hashedPassword,
                $userData['payment_method']
            );

            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return ['success' => true, 'message' => 'Registration successful'];
            } else {
                return ['success' => false, 'message' => 'Registration failed'];
            }
        } catch (mysqli_sql_exception $e) {
            return ['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()];
        }
    }

    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                // Start session and store user data
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                return ['success' => true, 'message' => 'Login successful'];
            }

            return ['success' => false, 'message' => 'Invalid username or password'];
        } catch (mysqli_sql_exception $e) {
            return ['success' => false, 'message' => 'Login failed: ' . $e->getMessage()];
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();
        session_destroy();
        return ['success' => true, 'message' => 'Logout successful'];
    }

    public function getUserById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (mysqli_sql_exception $e) {
            return null;
        }
    }

    public function updateUser($userId, $userData) {
        try {
            $updateFields = [];
            $types = "";
            $params = [];

            foreach ($userData as $key => $value) {
                if ($key !== 'id' && $key !== 'password' && $key !== 'role') {
                    $updateFields[] = "$key = ?";
                    $types .= "s";
                    $params[] = $value;
                }
            }

            if (isset($userData['password']) && !empty($userData['password'])) {
                $updateFields[] = "password = ?";
                $types .= "s";
                $params[] = password_hash($userData['password'], PASSWORD_DEFAULT);
            }

            $types .= "i"; // for the WHERE id = ? parameter
            $params[] = $userId;

            $sql = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = ?";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();

            if ($stmt->affected_rows >= 0) {
                return ['success' => true, 'message' => 'User updated successfully'];
            } else {
                return ['success' => false, 'message' => 'Update failed'];
            }
        } catch (mysqli_sql_exception $e) {
            return ['success' => false, 'message' => 'Update failed: ' . $e->getMessage()];
        }
    }
} 
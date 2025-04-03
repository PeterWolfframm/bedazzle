<?php
session_start();

$demo_username = "admin";
$demo_password = "password123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields";
        header('Location: ../login.php');
        exit;
    }

    if ($username === $demo_username && $password === $demo_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
        exit;
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header('Location: ../login.php');
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
} 
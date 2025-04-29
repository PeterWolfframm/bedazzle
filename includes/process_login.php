<?php
session_start();
require_once 'User.php';

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

    $user = new User();
    $result = $user->login($username, $password);

    if ($result['success']) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
    } else {
        $_SESSION['error'] = $result['message'];
        header('Location: ../login.php');
    }
    exit;
} else {
    header('Location: ../login.php');
    exit;
} 
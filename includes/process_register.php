<?php
session_start();
require_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect all form data
    $userData = [
        'salutation' => $_POST['salutation'] ?? '',
        'firstname' => $_POST['firstname'] ?? '',
        'lastname' => $_POST['lastname'] ?? '',
        'email' => $_POST['email'] ?? '',
        'username' => $_POST['username'] ?? '',
        'password' => $_POST['password'] ?? '',
        'address' => $_POST['address'] ?? '',
        'postalcode' => $_POST['postalcode'] ?? '',
        'city' => $_POST['city'] ?? '',
        'payment_method' => $_POST['payment_method'] ?? ''
    ];

    // Check if all required fields are filled
    foreach ($userData as $key => $value) {
        if (empty($value)) {
            $_SESSION['error'] = "All fields are required";
            header('Location: ../register.php');
            exit;
        }
    }

    // Create new user
    $user = new User();
    $result = $user->register($userData);

    if ($result['success']) {
        $_SESSION['success'] = $result['message'];
        header('Location: ../login.php');
    } else {
        $_SESSION['error'] = $result['message'];
        header('Location: ../register.php');
    }
    exit;
} else {
    header('Location: ../register.php');
    exit;
} 
<?php
session_start();
require_once "dbaccess.php";

// If already logged in, redirect to index
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Bedazzle ✨</title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <div class="container">
        <div class="welcome-section">
            <h1 class="welcome-title">Bedazzle</h1>
            <p>Welcome back, lovely! <span class="sparkle-fast">✨</span></p>
            
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="error-message">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            
            <form action="includes/process_login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html> 
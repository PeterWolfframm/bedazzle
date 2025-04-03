<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Bedazzle ✨</title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body>
    <nav class="nav-menu">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="profilepage.php">Profile</a></li>
                <li><a href="logout.php" class="btn">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-section">
            <h1 class="welcome-title">Welcome to Bedazzle</h1>
            <p>Hello <?php echo htmlspecialchars($_SESSION['username'] ?? 'Lovely User'); ?> <span class="sparkle-fast">✨</span></p>
            <p>We're so happy to have you here in our magical space <span class="sparkle-slow">✨</span></p>
        </div>
    </div>
</body>
</html> 
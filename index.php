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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --pink-primary: #ff69b4;
            --pink-darker: #ff1493;
            --pink-lighter: #ffb6c1;
        }
        
        .sparkle-fast { animation: sparkle 1s infinite; }
        .sparkle-slow { animation: sparkle 2s infinite; }
        @keyframes sparkle {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
        
        /* Override Bulma's primary color */
        .navbar.is-primary {
            background: linear-gradient(135deg, var(--pink-primary), var(--pink-darker));
        }
        .navbar.is-primary .navbar-brand > a.navbar-item,
        .navbar.is-primary .navbar-brand > a.navbar-item:hover,
        .navbar.is-primary .navbar-end > a.navbar-item,
        .navbar.is-primary .navbar-end > a.navbar-item:hover {
            color: white !important;
        }
        .hero.is-primary {
            background: linear-gradient(135deg, var(--pink-primary), var(--pink-darker));
        }
        .button.is-primary {
            background-color: var(--pink-primary);
        }
        .button.is-primary:hover {
            background-color: var(--pink-darker);
        }
        .button.is-light {
            background-color: white;
            color: var(--pink-primary);
        }
        .button.is-light:hover {
            background-color: #f5f5f5;
            color: var(--pink-darker);
        }
    </style>
</head>
<body>
    <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
                <span class="icon">
                    <i class="fas fa-sparkles"></i>
                </span>
                <strong>Bedazzle</strong>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navMenu" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item" href="index.php">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-home"></i>
                        </span>
                        <span>Home</span>
                    </span>
                </a>
                <a class="navbar-item" href="profilepage.php">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-user"></i>
                        </span>
                        <span>Profile</span>
                    </span>
                </a>
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-light" href="logout.php">
                            <span class="icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero is-primary is-medium">
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-1">
                    Welcome to Bedazzle
                    <span class="sparkle-fast">✨</span>
                </h1>
                <h2 class="subtitle is-3">
                    Hello <?php echo htmlspecialchars($_SESSION['username'] ?? 'Lovely User'); ?>!
                </h2>
                <p class="subtitle is-4">
                    We're so happy to have you here in our magical space 
                    <span class="sparkle-slow">✨</span>
                </p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
            });
        });
    </script>
</body>
</html> 
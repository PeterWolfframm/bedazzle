<?php
session_start();

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
        
        .hero.is-primary {
            background: linear-gradient(135deg, var(--pink-primary), var(--pink-darker));
        }
        .box {
            margin-top: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            border-top: 5px solid var(--pink-primary);
        }
        .title.has-text-primary {
            color: var(--pink-primary) !important;
        }
        .button.is-primary {
            background-color: var(--pink-primary);
        }
        .button.is-primary:hover {
            background-color: var(--pink-darker);
        }
        .input:focus {
            border-color: var(--pink-primary);
            box-shadow: 0 0 0 0.125em rgba(255, 105, 180, 0.25);
        }
        .label {
            color: var(--pink-darker);
        }
    </style>
</head>
<body>
    <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-5-tablet is-4-desktop is-3-widescreen">
                        <div class="box">
                            <h1 class="title has-text-centered has-text-primary">
                                Bedazzle
                                <span class="sparkle-fast">✨</span>
                            </h1>
                            <p class="subtitle has-text-centered mb-5">
                                Welcome back, lovely! <span class="sparkle-slow">✨</span>
                            </p>

                            <?php
                            if (isset($_SESSION['error'])) {
                                echo '<div class="notification is-danger is-light">' . 
                                     '<button class="delete"></button>' .
                                     htmlspecialchars($_SESSION['error']) . 
                                     '</div>';
                                unset($_SESSION['error']);
                            }
                            ?>

                            <form action="includes/process_login.php" method="POST">
                                <div class="field">
                                    <label class="label" for="username">Username</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" id="username" name="username" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label" for="password">Password</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="password" id="password" name="password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-primary is-fullwidth">
                                            <span class="icon">
                                                <i class="fas fa-sign-in-alt"></i>
                                            </span>
                                            <span>Login</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Delete button functionality for notifications
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;
                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
</body>
</html> 
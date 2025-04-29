<?php
/**
 * Database connection configuration
 * This file should be included at the beginning of index.php
 */

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection parameters
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'bedazzle');

// Create connection
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$con) {
    $_SESSION['error'] = "Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error();
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Set charset to UTF-8
$con->set_charset("utf8mb4"); 
<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'bedazzle');

if ($con->connect_error) {
    $_SESSION['error'] = "Fehler bei der Verbindung zur Datenbank";
    die("Verbindung fehlgeschlagen: " . $con->connect_error);
}

$userCheck = "SELECT * FROM users WHERE role = 'admin'";
$userResult = $con->query($userCheck);

if ($userResult->num_rows == 0) {
    $salutation = 'Frau';
    $username = 'admin123';
    $password_plain = 'admin123';
    $email = 'admin@shop.com';
    $firstname = 'Admin';
    $lastname = 'User';
    $address = 'Musterstraße 1';
    $postalcode = '12345';
    $city = 'Wien';
    $payment_method = 'PayPal';
    $role = 'admin';

    $hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

    $sql_insert = "INSERT INTO users (salutation, firstname, lastname, address, postalcode, city, email, username, password, payment_method, role)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql_insert);

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssss",
            $salutation,
            $firstname,
            $lastname,
            $address,
            $postalcode,
            $city,
            $email,
            $username,
            $hashed_password,
            $payment_method,
            $role
        );

        if ($stmt->execute()) {
            echo $_SESSION['success'] = "Admin-Benutzer erfolgreich erstellt.";
        } else {
            $_SESSION['error'] = "Fehler beim Einfügen des Admins: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Fehler beim Vorbereiten des Statements: " . $con->error;
    }
} else {
    echo "Admin-Benutzer ist bereits vorhanden.";
}

$con->close();
?>

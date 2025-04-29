<?php
require_once "includes/User.php";

$user = new User();
$result = $user->logout();

header('Location: login.php');
exit; 
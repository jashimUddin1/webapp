<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You are Logged out successfully";
setcookie("currentUser", $email, time() - (86400*7));
header("Location: login.php");
?>
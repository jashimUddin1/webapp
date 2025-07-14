<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "Please Login to Access User Data";
    header("Location: login.php");
    exit(0);
}
?>


<!-- user_con.php -->
<?php
include('authentication.php');

$user_email = $_SESSION['auth_user']['email'];
$email_parts = explode("@", $user_email);
$username = $email_parts[0];

$host =  "localhost";
$dbUser = "amarsite";
$dbPwd = ";7[Vq3B7NeJp4g";
$dbName = "amarsite_$username";

$con = mysqli_connect($host,$dbUser,$dbPwd,$dbName);
if(!$con){
die("Connection failed: ". mysqli_connect_error());
}


?>
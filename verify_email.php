<?php

$host =  "localhost";
$dbUser = "developerjasim";
$dbPwd = "kWM=}HR2isE-";
$dbName = "developerjasim_salary";

$con = mysqli_connect($host,$dbUser,$dbPwd,$dbName);
if(!$con){
die("Connection failed: ". mysqli_connect_error());
}
?>

<?php
session_start();
include("dbcon.php");

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token, verify_status, email FROM `users` WHERE verify_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($con, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_array($verify_query_run);
        if($row['verify_status'] == 0) {
            $clicked_token = $row['verify_token'];
            $user_email = $row['email'];
            $update_query = "UPDATE users SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";

            $update_query_run = mysqli_query($con, $update_query);
            if($update_query_run) {
                // Create a new database with the user's email
                $escaped_user_email = mysqli_real_escape_string($con, $user_email);

                $email_parts = explode("@", $escaped_user_email);
                $username = $email_parts[0];

                $create_db_query = "CREATE DATABASE `developerjasim_$username`";
                if(mysqli_query($con, $create_db_query)) {
                    $_SESSION['status'] = "Your account has been verified successfully and your database has been created!";
                } else {
                    $_SESSION['status'] = "Verification succeeded but failed to create database: ". mysqli_error($con) . "Please Contact Developer Jasim"; //
                }
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Verification failed!";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Email already verified. Please Login!";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "This token does not exist!";
        header("Location: login.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Not allowed";
    header("Location: login.php");
}
?>

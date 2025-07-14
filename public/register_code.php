<!-- code.php -->
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'dbcon.php';

if(isset($_POST['register_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $verify_token = md5(rand());

    // Email is Exit or Not
    $check_email_query = "SELECT email FROM `users` WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Id already Exits";
        header("Location: register.php");
        exit(0);
    }
    else
    {
        $query = "INSERT INTO `users`(`name`, `phone`, `email`, `password`, `verify_token`,`seDefaulRate`) VALUES ('$name','$phone','$email','$password','$verify_token','25')";
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            $_SESSION['status'] = "Registration Successful! Please verify your Email Address";
            header("Location: register.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Registration Failed";
            header("Location: register.php");
            exit(0);
        }
    }
}

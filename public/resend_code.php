<?php
session_start();
require 'dbcon.php';

// function resend_email_verify($name,$email,$verify_token){
    
// }

if(isset($_POST['resend_email_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);

        $checkemail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $checkemail_query_run = mysqli_query($con, $checkemail_query);

        if(mysqli_num_rows($checkemail_query_run) > 0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status'] == 0)
            {

                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                // resend_email_verify($name,$email,$verify_token);
                $_SESSION['status'] = "<span style='color:green'>Please wait admin is approve your email. thanks</span>";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "<span style='color:green'>Email already verified! Please Login</span>";
                header("Location: login.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "<span style='color:red'>Email is not register. Please register now.!</span>";
            header("Location: register.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "Please enter your email address";
        header("Location: resend_email.php");
        exit(0);
    }
}
?>
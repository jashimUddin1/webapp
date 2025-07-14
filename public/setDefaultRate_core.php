<?php
include "dbcon.php";
include "authentication.php";

if (isset($_POST['setDefaultRate_btn'])) {
    // ডাটাবেস থেকে বর্তমান ব্যবহারকারীর ID বের করা
    $userId = $_SESSION['auth_user']['id']; // নিশ্চিত করুন সেশনে `user_id` আছে
    $newRate = $_POST['rate'];

    // মান ভ্যালিডেশন: সংখ্যা, ধনাত্মক, ২০ বা তার বেশি এবং ৪০ বা তার কম হতে হবে
    if (!is_numeric($newRate) || $newRate < 20 || $newRate > 40) {
        $_SESSION['status'] = "Rate must be between 20 and 40.";
        header("Location: profile.php");
        exit(0);
    }

    // পূর্বের মান ডাটাবেস থেকে সেশনের মাধ্যমে চেক করা
    $currentRate = $_SESSION['auth_user']['setDefaultRate'];

    // যদি পুরানো এবং নতুন মান সমান হয়
    if ($currentRate == $newRate) {
        $_SESSION['status'] = "There are the same value.";
        header("Location: profile.php");
        exit(0);
    }

    // ডাটাবেস আপডেট কুয়েরি
    $query = "UPDATE users SET setDefaultRate = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("di", $newRate, $userId);

    if ($stmt->execute()) {
        // সেশন আপডেট করা
        $_SESSION['auth_user']['setDefaultRate'] = $newRate;
        $_SESSION['status'] = "Default rate updated successfully!";
        header("Location: profile.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Something went wrong. Please try again.";
        header("Location: profile.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Unauthorized access!";
    header("Location: profile.php");
    exit(0);
}
?>

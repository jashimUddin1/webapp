
<!-- save_data.php -->
<?php
require 'user_con.php';

if(isset($_POST['submit_btn']))
{
    // Retrieve the table name from the hidden input field
    $tableName = mysqli_real_escape_string($con, $_POST['tableName']);

    // Retrieve form data
    $date = mysqli_real_escape_string($con, $_POST["input1"]);
    $recv = mysqli_real_escape_string($con, $_POST["input2"]);
    $delv = mysqli_real_escape_string($con, $_POST["input3"]);
    $rate = mysqli_real_escape_string($con, $_POST["input4"]);

    // Calculate total
    $total = $delv * $rate;

    // Prepare and execute SQL statement
    $sql = "INSERT INTO `$tableName` (date, received, delivered, rate, total) VALUES (?, ?, ?, ?, ?)";


$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
  mysqli_stmt_bind_param($stmt, "sssss", $date, $recv, $delv, $rate, $total);
  mysqli_stmt_execute($stmt);
  
  $_SESSION['status'] = "New record inserted successfully";
  header("Location: index.php");
} else {
  $_SESSION['status'] = "Table is not found! Please Create Table";
  header("Location: admin.php");
}

mysqli_stmt_close($stmt);
// Close connection
}
?>

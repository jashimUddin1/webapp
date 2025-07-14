
<!-- update_data.php -->
<?php
require 'user_con.php';

if(isset($_POST['update_count']))
{
    $tableName = mysqli_real_escape_string($con, $_POST['tableName']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $received = mysqli_real_escape_string($con, $_POST['received']);
    $delivered = mysqli_real_escape_string($con, $_POST['delivered']);
    $rate = mysqli_real_escape_string($con, $_POST['rate']);
    $total = $delivered * $rate;

    $query = "UPDATE `$tableName` SET date='$date', received='$received', delivered='$delivered', rate='$rate', total='$total' WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data updated successfully";
        header("Location: admin.php?table=$tableName");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data update failed";
        header("Location: admin.php?table=$tableName");
        exit(0);
    }
}
?>

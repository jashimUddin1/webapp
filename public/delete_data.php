
<!-- delete_data.php -->
<?php
require 'user_con.php';

if(isset($_POST['delete_count']))
{
    $tableName = mysqli_real_escape_string($con, $_POST['tableName']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM `$tableName` WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Data Deleted Successfully";
        header("Location: admin.php?table=".urlencode($tableName));
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Failed to Delete Data";
        header("Location: admin.php?table=".urlencode($tableName));
        exit(0);
    }
}
else
{
    $_SESSION['message'] = "Invalid Request";
    header("Location: admin.php");
    exit(0);
}
?>


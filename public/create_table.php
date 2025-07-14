
<!-- create_table.php -->
<?php
require 'user_con.php';

if (isset($_POST['create_table_btn'])) {
    $tableName = mysqli_real_escape_string($con, $_POST["tableName"]);
    
    // Check if the table name contains space
    if (strpos($tableName, ' ') !== false) {
        $_SESSION['status'] = "Space is not allowed in table name.";
        header("Location: admin.php");
        exit(0);
    }

    // Check if the table already exists
    $checkTableQuery = "SHOW TABLES LIKE '$tableName'";
    $checkTableResult = mysqli_query($con, $checkTableQuery);

    if (mysqli_num_rows($checkTableResult) > 0) {
        // If the table exists, alert the user
        $_SESSION['status'] = "Table '$tableName' already exists. Please choose a different name.";
        header("Location: admin.php");
        exit(0);
    } else {
        // If the table does not exist, create it
        $query = "CREATE TABLE `$tableName`(
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `date` VARCHAR(255) NOT NULL,
            `received` VARCHAR(255) NOT NULL,
            `delivered` INT(11) NOT NULL,
            `rate` INT(11) NOT NULL,
            `total` INT(11) NOT NULL,
            PRIMARY KEY(`id`)
        ) ENGINE = INNODB";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['status'] = "Table '$tableName' Inserted Successfully";
            header("Location: admin.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Table Not Inserted";
            header("Location: admin.php");
            exit(0);
        }
    }
}
?>



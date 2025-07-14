<?php
include("dbcon.php");

$sql = "SELECT * FROM users"; // Replace 'your_table' with your actual table name
$result = mysqli_query($con, $sql);

// Check query execution
if (mysqli_num_rows($result) > 0) {

    // Loop through each row of data and display in table cells
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["verify_token"] . "</td>";
        echo "<td>" . $row["verify_status"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
      echo "</tr>";
    }
} else {
  echo "<center>No data found in the table</center>";
}

mysqli_close($con);
?>
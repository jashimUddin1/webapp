<?php
// Function to remove the first two characters from a string
function removeFirstTwoChars($string) {
    return substr($string, 2);  // Remove the first two characters
}

echo "<!-- Start fetching table -->"; // Debugging marker

if (isset($_GET['table']) && !empty($_GET['table'])) {
    include("user_con.php");
    $tableName = $_GET['table'];

    // Apply the function to remove the first two characters
    $modifiedTableName = removeFirstTwoChars($tableName);

    // Output the selected table name for debugging
    echo "<div class='container selectTable'>Selected Month: <span>" . htmlspecialchars($modifiedTableName) . "</span></div>";

    // Sanitize table name
    $tableName = mysqli_real_escape_string($con, $tableName);

    $sql = "SELECT * FROM $tableName";
    $result = mysqli_query($con, $sql);

    echo "<table border='1' id='data-table'>
            <thead>
                <tr>
                    <th colspan='5'>$modifiedTableName</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>Received</th>
                    <th>Delivered</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id='data-table-body'>";

    // Check if the table has any data
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['date']}</td>
                    <td>{$row['received']}</td>
                    <td>{$row['delivered']}</td>
                    <td>{$row['rate']}</td>
                    <td>{$row['total']}</td>
                  </tr>";
        }
    } else {
        // If no data is found, show "Table data not found" in the table body
        echo "<tr><td colspan='5' style='text-align:center;color:red;'>Table data not found</td></tr>";
    }

    echo "</tbody></table>";
    $con->close();
} else {
    // If the table itself is not found, show an alert
    echo "<center style='color:red'>Table Not Found</center>";
}

echo "<!-- End fetching table -->"; // Debugging marker
?>

<!-- raw.php -->
<?php
// Database connection
include("user_con.php");

// Function to fetch and display data from a table
function displayTableData($con, $tableName) {
    $sql = "SELECT * FROM $tableName";
    $result = $con->query($sql);

    echo "<table id='dataTable' class='table table-bordered table-striped'>
            <thead>
                <tr>
                    <th colspan='7'>$tableName</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Received</th>
                    <th>Deliverd</th>
                    <th>Rate</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id='data-table-body'>";

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $row_id = $row['id'];
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['received']}</td>
                    <td>{$row['delivered']}</td>
                    <td>{$row['rate']}</td>
                    <td>{$row['total']}</td>
                    <td>     
                        <a href='edit_data.php?id=$row_id' class='btn btn-success btn-sm'>Edit</a>
                        <a href='delete_data.php?id=$row_id' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }

    echo "</tbody></table><br>";
}

// Check if a specific table is requested
if (isset($_GET['table'])) {
    $tableName = $_GET['table'];
    displayTableData($con, $tableName);
} else {
    echo "Please select a table from the dropdown menu.";
}

$con->close();
?>


<!-- fetch_for_admin.php -->
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
    echo "<div class='container selectTable'>Selected Table: <span>" . htmlspecialchars($modifiedTableName) . "</span></div>";

    // Sanitize table name
    $tableName = mysqli_real_escape_string($con, $tableName);

    $deletAlert = "Are you sure?"; // Changed the alert text here if needed
    $sql = "SELECT * FROM $tableName";
    $result = mysqli_query($con, $sql);

    echo "<table id='dataTable' class='table table-bordered table-striped'>
            <thead>
                <tr>
                    <th colspan='6'>$modifiedTableName</th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>Received</th>
                    <th>Delivered</th>
                    <th>Rate</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id='data-table-body'>";
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $row_id = $row['id'];
            echo "<tr>
                    <td data-label='Date'>{$row['date']}</td>
                    <td data-label='Received'>{$row['received']}</td>
                    <td data-label='Delivered'>{$row['delivered']}</td>
                    <td data-label='Rate'>{$row['rate']}</td>
                    <td data-label='Total'>{$row['total']}</td>
                    <td data-label='Action'>
                        <a href='edit_data.php?id=$row_id&table=$tableName' class='btn btn-success btn-sm'>Edit</a>
                        <form action='delete_data.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='student_id' value='{$row['id']}'>
                            <input type='hidden' name='tableName' value='".htmlspecialchars($tableName)."'>
                            <button type='submit' name='delete_count' class='btn btn-danger btn-sm' onclick='return confirmDelete()'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
    }
    
    echo "</tbody></table>";

    $con->close();
} else {
    echo "<center style='color:red'>Table Not Found</center>";
}
echo "<!-- End fetching table -->"; // Debugging marker
?>
<script>
function confirmDelete() {
    return confirm("Are you sure?");
}
</script>
<!-- 
ok fine .. now i want to do when user click delete button then alert("are you sure") if yes then delete if cancel then go back  -->
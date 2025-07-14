<!-- admin_bar.php -->
<div class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Developer Jasim</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav text-center ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>

                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        All Table
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                            include("user_con.php");
                                            $sql = "SHOW TABLES";
                                            $result = $con->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_array()) {
                                                    $tableName = $row[0];
                                                    echo "<li><a class='dropdown-item' href='admin.php?table=$tableName'>$tableName</a></li>";
                                                }
                                            }
                                            $con->close();
                                        ?>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createTableModal">Add New</a>
                                        </li>

                                    </ul>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-danger" href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>


<!-- Modal for creating a new table -->
<div class="modal fade" id="createTableModal" tabindex="-1" aria-labelledby="createTableModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createTableModalLabel">Create New Table</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="create_table.php" method="POST" id="createTableForm">
          <div class="mb-3">
            <label for="tableName" class="form-label">Table Name</label>
            <input type="text" class="form-control" id="tableName" name="tableName" required>
          </div>
          <div id="tableHeadingsContainer"></div>
          <button name="create_table_btn" type="submit" class="btn btn-primary">Create Table</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function validateTableName() {
    var tableName = document.getElementById("tableName").value;
    if (tableName.includes(" ")) {
        alert("Space is not allowed in table name");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}
</script>

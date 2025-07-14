<!-- edit_data.php -->
<?php
require 'user_con.php';
include('includes/header.php');
?>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data
                        <a href="admin.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php
                    if(isset($_GET['id']) && isset($_GET['table'])) 
                    {
                        $tableName = mysqli_real_escape_string($con, $_GET['table']); // Correctly retrieve table name from URL
                        $student_id = mysqli_real_escape_string($con, $_GET['id']); // Retrieve ID from URL

                        $query = "SELECT * FROM `$tableName` WHERE id='$student_id'"; // Use backticks for table name
                        $query_run = mysqli_query($con, $query);

                        if(mysqli_num_rows($query_run) > 0)
                        {
                            $student = mysqli_fetch_array($query_run);
                            ?>
                            <form action="update_data.php" method="POST"> <!-- Action updated to point to update script -->
                                <input type="hidden" name="student_id" value="<?= $student['id']; ?>">
                                <input type="hidden" name="tableName" value="<?= htmlspecialchars($tableName); ?>"> <!-- Pass table name in hidden field -->

                                <div class="mb-3">
                                    <label>Date</label>
                                    <input type="date" name="date" value="<?=$student['date'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Received</label>
                                    <input type="text" name="received" value="<?=$student['received'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Delivered</label>
                                    <input type="int" name="delivered" value="<?=$student['delivered'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Rate</label>
                                    <input type="int" name="rate" value="<?=$student['rate'];?>" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <button type="submit" name="update_count" class="btn btn-primary">
                                        Update Data
                                    </button>
                                </div>

                            </form>
                            <?php
                        }
                        else
                        {
                            echo "<h4>No Such Id Found</h4>";
                        }
                    }
                    else
                    {
                        echo "<h4>Invalid Request</h4>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

    
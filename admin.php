
<!-- admin.php -->
<?php
    $page_title = "Admin Panel";
    include('includes/header.php');
    include('includes/admin_bar.php');
    include("user_con.php");

    // Check if a table is passed via the URL; if not, fetch the latest table
    if (!isset($_GET['table'])) {
        $result = mysqli_query($con, "SHOW TABLES");
        $tables = [];
        while ($row = mysqli_fetch_array($result)) {
            $tables[] = $row[0];
        }
        $latest_table = end($tables); // Get the latest table (last in the array)
        $_GET['table'] = $latest_table; // Set it as the current table
    }

    $con->close();
?>

<div class="container mt-4">
    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <?php 
                if(isset($_SESSION['status'])) {
                    ?>
                    <div class="alert alert-success text-center">
                        <h5><?= $_SESSION['status']?></h5>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                }
            ?>
                
            <div class="card-body">             
                <div class="table-responsive">
                    <?php include 'fetch_for_admin.php'; ?>
                </div>


                <div class="form-container mt-4">
    <form id="myForm" action="save_data.php" method="POST">
        <?php 
        $setDefaultRate = $_SESSION['auth_user']['setDefaultRate'];
        ?>
        <!-- Hidden field to pass the table name -->
        <input type="hidden" name="tableName" value="<?= htmlspecialchars($_GET['table']) ?>">
        
        <div class="input-field">
            <input type="date" id="input1" name="input1" required placeholder="Date"/>
        </div>
        <div class="input-field">
            <input type="text" id="input2" name="input2" required placeholder="Received" />
        </div>
        <div class="input-field">
            <input type="number" id="input3" name="input3" required placeholder="Delivered" />
        </div>
        <div class="input-field">
            <input type="number" value="<?= htmlspecialchars($setDefaultRate) ?>" id="input4" name="input4" required placeholder="Rate" />
        </div>
        <button class="btn btn-primary" name="submit_btn" id="submitBtn" type="submit">Submit</button>
    </form>
</div>

            </div>                       
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

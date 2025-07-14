<?php
    include('dbcon.php');
    include('authentication.php');
    $page_title = "Profile";
    include('includes/header.php');
    include('includes/navbar.php');
?>

<div class="container mt-4">
    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <?php 
            if (isset($_SESSION['status'])) {
                ?>
                <div class="alert alert-success text-center">
                    <h5><?= $_SESSION['status'] ?></h5>
                </div>
                <?php
                unset($_SESSION['status']);
            }
            ?>

            <div class="card mb-5">
                <div class="card-header">
                    <h4>User Dashboard</h4>
                </div>
                <div class="card-body">
                    <h5>User Name: <?= $_SESSION['auth_user']['username'] ?> </h5> 
                    <h5>User Id: <?= $_SESSION['auth_user']['id'] ?> </h5> 
                    <h5>Phone: <?= $_SESSION['auth_user']['phone'] ?> </h5>                        
                    <h5>Email: <?= $_SESSION['auth_user']['email'] ?> </h5>

                    <!-- Default Rate Row -->
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h5>Default Rate: <?= $_SESSION['auth_user']['setDefaultRate'] ?> Taka</h5>
                        <button class="btn btn-sm btn-primary" id="changeRateBtn">Change</button>
                    </div>

                    <!-- Form (Initially Hidden) -->
                    <form action="setDefaultRate_core.php" method="POST" id="rateForm" style="display: none; margin-top: 10px;">
                        <div class="input-field">
                            <label for="rate">Set Default Rate</label>
                            <input 
                                type="number" 
                                value="<?= htmlspecialchars($_SESSION['auth_user']['setDefaultRate']) ?>" 
                                id="rate" 
                                name="rate" 
                                required 
                                placeholder="Rate" 
                                min="20"
                                max="40"
                            />
                        </div>
                        <button class="btn btn-primary" name="setDefaultRate_btn" id="setDefaultRate_btn" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to toggle the form visibility
    document.getElementById('changeRateBtn').addEventListener('click', function () {
        const form = document.getElementById('rateForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    });
</script>

<?php include('includes/footer.php'); ?>

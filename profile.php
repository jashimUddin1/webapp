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
                        if(isset($_SESSION['status']))
                        {
                            ?>
                            <div class="alert alert-success text-center">
                                <h5><?= $_SESSION['status']?></h5>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                    ?>
                    <div class="card mb-5">
                    <div class="card-header">
                        <h4>User Dashbord</h4>
                    </div>
                    <div class="card-body">
                        <h5>User Name: <?= $_SESSION['auth_user']['username']?> </h5>                        
                        <h5>Phone: <?= $_SESSION['auth_user']['phone']?> </h5>                        
                        <h5>Email: <?= $_SESSION['auth_user']['email']?> </h5>                                                       
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php include('includes/footer.php'); ?>
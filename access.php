<?php 
$page_title = "Admin access page";
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <table class="table table-striped table-hover" id="dataTable">
                <thead>
                <tr class="table-dark">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Verify token</th>
                    <th>Verify status</th>
                    <th>Create At</th>
                </tr>
                </thead>
                <tbody id="tableData">
                <?php include 'access_core.php'; 
                ?>
                </tbody>
            </table>
            </div>
            <div class="input-group mb-3">
                <input type="text" id="input" class="form-control" placeholder="Enter verify token to create verify link" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                <span class="input-group-text btn btn-primary rounded-end-3" id="linkCreate">Create Link</span>
            </div>
            <h5 id="linkText"></h5>          
        </div>
    </div>
</div>

<script>
    const linkBtn = document.getElementById("linkCreate");

    linkBtn.addEventListener("click",function(){
        const input = document.getElementById("input").value;
        const linkText = document.getElementById("linkText");
        const trimInput = input.trim();

        if(trimInput == ''){
            alert("please enter verify token!");
        }else{
            linkText.innerHTML = "https://salary.developerjasim.top/public/verify_email.php?token="+input;
        }

        
    }); 
</script>
<?php include('includes/footer.php'); ?>
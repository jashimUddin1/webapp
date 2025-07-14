
<!--index.php>-->
<?php 
$page_title = "Home Page";
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

<!DOCTYPE html>
<html>
<head>
<title></title>
<style type="text/css">
  /* my library */
.container{
  width: 96%;
  margin: 10px 2%;
}
/* my library end */

body{
  width: 100%;
  margin: 0;
  padding: 0;
}

/*start css for header and menu*/
.headerWrapper{
  width: 100%;
  background: #212529;
  padding: 8px 0px;
}
.header {
    display: grid;
    width: 96%;
    margin: 0px 2%;
    grid-template-columns: 1fr 2fr;
    grid-template-rows: 1fr;
    font-size: 18px;
}
.headerLogo{
  margin-top: 2px;
}
.headerLogo a{
  color: white;
  text-decoration: none;
  font-style: italic;
  padding: 2px 10px;
}
.headerLogo a:hover {
    font-style: normal;
    font-size: 20px;
    transition: 0.5s;
}
.headerMenu {
    display: flex;
    justify-content: flex-end;
}
.headerMenu li{
    list-style: none;
    margin-right: 7px;
    background: #323636;
    padding: 2px 10px;
    border-radius: 8px;
}
.headerMenu li:hover {
    background: #5c5a5a;
    font-style: italic;
    font-size: 19px;
    transition: 0.5s;
}
.headerMenu li a{
  text-decoration: none;
  color:white;
}
.menuIcon {
    display: none;
}
span.icon {
    color: white;
    font-size: 20px;
    background: #323636;
    padding: 2px 10px;
    position: relative;
}
span.icon:hover{
    background: #5c5a5a;
    font-size: 22px;
    transition: 0.5s;
}

@media(max-width: 570px){
    body{
        font-size:11px;
    }
  .header {
    grid-template-columns: 1fr 1fr;
  }
  .headerMenu {
    display: none;
  }
  .headerMenu li{
    margin-bottom: 2px;
    background: #323636;
    padding: 2px 10px;
    border-radius: 8px;
  }
  .menuIcon {
    display: block;
    text-align: right;
    padding: 0px 10px;
  }
}
/* css end for menu and header  */

.tabledataWrapper {
    width: 100%;
}

#data-table{
  width: 96%;
  margin: 10px 2%;
  font-size:xx-large;
  margin-bottom:30px;
}

tr{
text-align:center;
}

#tDetails{
  width: 96%;
  margin: 10px 2%;
  padding: 10px 5px;
}
.greenWhite{
background:green;
color:white;
}
.green{
color:green;
}
.red{
color:red;
}

.tDetails{
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(185px,1fr));
    grid-gap: 5px;
}

@media(max-width: 1000px){
    .tDetails{
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 15px;
        grid-row-gap: 5px;
    }
}
@media(min-width: 999px){
    .tDetails div{
      font-size:16px!important;
    }
}
.tDetails div{
  background: yellow;
  padding: 5px;
  font-size:8px;
}


.tDetails div:nth-child(1),.tDetails div:nth-child(3){
    background: antiquewhite;
    color:;
}
.tDetails div:nth-child(2),.tDetails div:nth-child(6){
    background: lightgreen;
    color:;
}
.tDetails div:nth-child(4){
  background: green;
  color: white;
  font-weight: 600;
}
.tDetails div:nth-child(5){
    background: antiquewhite;
    color:red; 
}
.tDetails div:nth-child(7),.tDetails div:nth-child(10){
    background: lightgreen;
    color:;
}
.tDetails div:nth-child(12){
  background: aqua;
}
.tDetails div:nth-child(13){
  background: royalblue;
}
.tDetails div:nth-child(15),.tDetails div:nth-child(17),.tDetails div:nth-child(19){
  background: antiquewhite;
}
.tDetails div:nth-child(8),.tDetails div:nth-child(11),.tDetails div:nth-child(14),.tDetails div:nth-child(16),.tDetails div:nth-child(18){
  background: lightblue;
}
.tDetails div:nth-child(21),.tDetails div:nth-child(20){
  background: green;
  color: white;
  font-weight: 600;
}


.selectTable{
  background: #323636;
  padding: 6px 10px;
  border-radius: 8px;
  color:white;
  width: fit-content;
  font-size: larger;
}
.selectTable span {
  color: aquamarine;
}

.headerMenu ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
}

.headerMenu li {
  position: relative;
}

.headerMenu .dropdown {
  position: relative;
  display: inline-block;
}

.headerMenu .dropbtn {
  cursor: pointer;
}

.headerMenu .dropdown-content {
  margin-top: 10px;
  margin-left:-10px;
  display: none;
  position: absolute;
  min-width: 160px;
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.headerMenu .dropdown-content a {
  margin-bottom: 2px;
  background: #323636;
  padding: 2px 10px;
  border-radius: 8px;
  color: white;
  text-decoration: none;
  display: block;
}

.headerMenu .dropdown-content a:hover {
  background-color: #ddd;
  color:black;
}

.headerMenu .dropdown:hover .dropdown-content {
  display: block;
}

.headerMenu .dropdown:hover .dropbtn {
  background-color: #555;
}
</style>

</head>
<body>

<div class="headerWrapper">
  <div class="header">
    <div class="headerLogo">
      <a href="#">Developer Jasim</a>
    </div>

    <div class="menuIcon">
      <span class="icon">&#9776;</span>
    </div>

    <div class="headerMenu">
      <ul>
        <!-- Month Dropdown -->
        <li class="dropdown">
          <a href="#" class="dropbtn">Month</a>
          <div class="dropdown-content">
            <?php
              include("user_con.php");
              $sql = "SHOW TABLES";
              $result = $con->query($sql);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_array()) {
                      $tableName = $row[0];
                      echo "<a href='index.php?table=$tableName'>$tableName</a>";
                  }
              }
              $con->close();
            ?>
          </div>
        </li>
        <!-- Admin Panel Link -->
        <li><a id="adminBtn" href="admin.php">Admin Panel</a></li>
      </ul>
    </div>
  </div>
</div>


<div class="tabledataWrapper">
  <?php include 'fetch_data.php'; ?> <!--<table border='1' id='data-table'>-->
  <!--<tbody id='data-table-body'> this data in coming to database it just id name-->
</div>


<div class="tdetailsWrapper">
         
  <div  class="tDetails container">

    <div class="receivedTotal">     <!--1-->
      Received Total: <span id="rcvdTotal"> </span>
    </div>
    
    <div class="deliveredTotal">    <!--2-->
      Delivered Total: <span id="dlvrdTotal"> </span>
    </div>
    
    <div class="returnedTotal">    <!--3-->
      Returned Total: <span id="returnTotal"> </span>
    </div>

    <div class="deliverdRate green">    <!--4-->
      Delivered Rate: <span id="dlvrdRate"></span>%
    </div>

    <div class="returnRate red">    <!--5-->
      Return Rate: <span id="returnRate"></span>%
    </div>
    
    <div class="possibleTotal">    <!--6-->
      Possible Total: <span id="posiTotal"> </span>(ps)
    </div>
    
    <div class="totalDay">    <!--7-->
      Total Day:  <span id="totalDay"> </span>
    </div>

    <div class="offDay">    <!--8-->
      Off Day:  <span id="offDay"> </span>
    </div>

    <div style="display:none;">    <!--9-->
     
    </div>
    
    <div class="totalWorkDay">    <!--10-->
      Working Day:  <span id="totalWrkDay"> </span>
    </div>
   
    <div class="possibleWorkDay">    <!--11-->
       Day:  <span id="possibleTotalWrkDay"> </span>(Possible)
    </div>
    
    <div class="highDel">    <!--12-->
        Highest Delivered:  <span id="highDel"> </span>
    </div>

    <div class="lowDel">    <!--13-->
        Lowest Delivered:  <span id="lowDel"> </span>
    </div>
    
    <div class="avarageDelivery">    <!--14-->
        Average Delivery:  <span id="avarDel"> </span>
    </div>
    
    <div class="avarageTk">    <!--15-->
         Average Incentive:  <span id="avarTk"> </span>
    </div>
    
    <div class="avarageTotal">    <!--16-->
         Average Total:  <span id="avarageTotalTk"> </span> (tk)
    </div>

    <div class="possibleIncome">    <!--17-->
        Possible Incentive:  <span id="possibleIncome"> </span>
    </div>
    
    <div class="grossSalary">    <!--18-->
        Fixed Salary:  <span id="grossSalary"> </span>
    </div>
    
    <div class="estimetTotal">    <!--19-->
       Estimated Total:  <span id="estimatedTotal"> </span>
    </div>
    
    <div class="comissionTotal">    <!--20-->
      Comission Tk: <span id="totalTk"> </span>
    </div>
    
    <div class="salary">    <!--21-->
        Salary:  <span id="salaryTk"> </span>
    </div>

    
    <div id="absentRow" class="red">    <!--9-->
      Absent:  <span id="absent"> </span>
    </div>
    
  </div>
    
    
    
  <div class="container" id="finishedSalary">
	<h1>Total Salary: <span id="salaryTotal"></span> tk</h1>
  </div>

</div>
<br>

<script type="text/javascript" src="index.jsx"></script>
<script>
  const icon = document.querySelector(".icon");
  const headerMenu = document.querySelector(".headerMenu");


  icon.addEventListener("click", () => {
    headerMenu.style.display = headerMenu.style.display === "block" ? "none" : "block";
  });
  
  
//   code for dropdown menu
  document.addEventListener("DOMContentLoaded", function () {
  const dropdown = document.querySelector(".dropbtn");
  const dropdownContent = document.querySelector(".dropdown-content");

  // Toggle on click
  dropdown.addEventListener("click", function (e) {
    e.preventDefault(); // Default action বন্ধ রাখে
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });

  // Show dropdown on hover
  dropdown.addEventListener("mouseenter", function () {
    dropdownContent.style.display = "block";
  });

  // Hide dropdown when mouse leaves the dropdown area
  dropdownContent.addEventListener("mouseleave", function () {
    dropdownContent.style.display = "none";
  });

  // Close dropdown on outside click
  document.addEventListener("click", function (event) {
    if (!dropdown.contains(event.target) && !dropdownContent.contains(event.target)) {
      dropdownContent.style.display = "none";
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const dropdownItems = document.querySelectorAll(".dropdown-content a");

  dropdownItems.forEach(function (item) {
    const originalText = item.textContent; // মূল টেক্সট নেয়া
    if (originalText.length > 2) {
      item.textContent = originalText.substring(2); // প্রথম ২ অক্ষর বাদ দিয়ে বাকিটা দেখানো
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const selectedMonthSpan = document.querySelector("#selectedMonth span");
  if (selectedMonthSpan) {
    const originalText = selectedMonthSpan.textContent; // মূল টেক্সট
    if (originalText.length > 2) {
      selectedMonthSpan.textContent = originalText.substring(2); // প্রথম ২ অক্ষর বাদ
    }
  }
});

</script>
</body>
</html>
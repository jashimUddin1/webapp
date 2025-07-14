<?php
require 'dbcon.php';

if(isset($_GET['name'])){
    $tname = mysqli_real_escape_string($con, $_GET['name']);
    $ttitle = mysqli_real_escape_string($con, $_GET['title']);
    $trow = mysqli_real_escape_string($con, $_GET['row']);
    $thone = mysqli_real_escape_string($con, $_GET['one']);
    $thtwo = mysqli_real_escape_string($con, $_GET['two']);
    $ththree = mysqli_real_escape_string($con, $_GET['three']);
    $thfour = mysqli_real_escape_string($con, $_GET['four']);                         
    $thfive = mysqli_real_escape_string($con, $_GET['five']);                         
    $thsix = mysqli_real_escape_string($con, $_GET['six']);

    echo '<table id="dataTable" class="table table-bordered table-striped">';
        echo "<thead>";
          echo "<tr>";
            echo "<th colspan=".$trow.">".$ttitle."</th>";
          echo "</tr>";
          echo "<tr>";
            echo "<th>" . $thone . "</th>";
            echo "<th>" . $thtwo . "</th>";
            echo "<th>" . $ththree . "</th>";
            echo "<th>" . $thfour . "</th>";
            echo "<th>" . $thfive . "</th>";
            echo "<th>" . $thsix . "</th>";
          echo "</tr>";
        echo "</thead>";
    echo "</table>";

   
}
?>
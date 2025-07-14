<?php //index.php 
session_start();
include("db/dbcon.php");

if (!isset($_SESSION['authenticated'])) {
  header("location: login/index.php");
  exit();
}

$monthOrder = "'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'";

$user_id = $_SESSION["auth_user"]["id"];
$sql = "SELECT year, month FROM month WHERE user_id='$user_id' ORDER BY year ASC, FIELD(`month`, $monthOrder)";
$result = $con->query($sql);

$yearMonthData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $year = htmlspecialchars($row['year']);
        $month = htmlspecialchars($row['month']);
        $yearMonthData[$year][] = $month;
    }
}

$monthDESC = "'December', 'November', 'October', 'September', 'August', 'July', 'June', 'May', 'April', 'March', 'February', 'January'";

$sqlLatest = "SELECT `year`, `month` FROM `month` WHERE user_id='$user_id' ORDER BY `year` DESC, FIELD(`month`, $monthDESC) LIMIT 1";
$resultLatest = $con->query($sqlLatest);
$latestYear = null;
$latestMonth = null;

if ($resultLatest->num_rows > 0) {
    $rowLatest = $resultLatest->fetch_assoc();
    $latestYear = $rowLatest['year'];
    $latestMonth = $rowLatest['month'];
}

$year = isset($_GET['year']) ? $_GET['year'] : $latestYear;
$month = isset($_GET['month']) ? $_GET['month'] : $latestMonth;


$sql2 = "SELECT day FROM month WHERE user_id='$user_id' AND month='$month' AND year='$year' ";
$result2 = $con->query($sql2);

if ($result2->num_rows > 0) {
   $row = $result2->fetch_assoc();
        $month_day = htmlspecialchars($row['day']);
}



echo $month_day;



$stmt = $con->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

$besic_salary = $user_data['basic_salary'];
$rider_type = $user_data['riderType'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
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
        <li class="nav-item dropdown">
          <div id="yearNavigator" style="display: flex; align-items: center; gap: 10px; cursor: pointer; position: relative;">
            <button id="prevYearBtn">&lt;</button>
            <span id="currentYear" class="dropbtn" style="color: white;">Year</span>
            <button id="nextYearBtn">&gt;</button>
            <ul id="monthDropdown" class="dropdown-menu dropdown-content" style="position: absolute; top: 30px; display: none; background: white; border: 1px solid #ccc; padding: 5px; z-index: 1000;"></ul>
          </div>
        </li>

        <li><a id="adminBtn" href="admin">Admin Panel</a></li>
      </ul>
    </div>
  </div>
</div>

<?php include "includes/session.php"; ?>

<div style="margin-top:5px;" class="tabledataWrapper">
  <?php include 'includes/fetch_data.php'; ?>
</div>

<div class="tdetailsWrapper">
  <div class="tDetails container">
    <div class="receivedTotal lgb">Received Total: <span id="rcvdTotal"> </span></div>
    <div class="deliveredTotal gw">Delivered Total: <span id="dlvrdTotal"> </span></div>
    <div class="cancelTotal awr">Cancel Total: <span id="cancelTotal"> </span></div>
    <div class="rescheduledTotal awb">Rescheduled Total: <span id="rescheduledTotal"> </span></div>
    <div class="returnedTotal awr">Returned Total: <span id="returnTotal"> </span></div>

    <div class="deliverdRate gw">Delivered Rate: <span id="dlvrdRate"></span>%</div>
    <div class="returnRate awr">Return Rate: <span id="returnRate"></span>%</div>
    <div class="possibleTotal gw">Possible Total: <span id="posiTotal"> </span>(ps)</div>
    <div class="totalDay lgb">Total Day:  <span id="totalDay"> </span></div>
    <div class="offDay awb">Off Day:  <span id="offDay"> </span></div>
    <div id="absentRow" class="awr red">Absent:  <span id="absent"> </span></div>

    <div class="totalWorkDay lgb">Working Day:  <span id="totalWrkDay"> </span></div>
    <div class="possibleWorkDay gw">Day:  <span id="possibleTotalWrkDay"> </span>(Possible)</div>
    <div class="highDel gw">Highest Delivered:  <span id="highDel"> </span></div>
    <div class="lowDel bg_royalblue ">Lowest Delivered:  <span id="lowDel"> </span></div>
    <div class="avarageDelivery lb">Average Delivery:  <span id="avarDel"> </span></div>
    
    <div class="avarageTk bg_aqua">Average Incentive:  <span id="avarTk"> </span></div>
    <div class="avarageTotal bg_aqua">Average Total:  <span id="avarageTotalTk"> </span> (tk)</div>
    <div class="possibleIncome bg_aqua">Possible Incentive:  <span id="possibleIncome"> </span></div>
    <div class="grossSalary bg_aqua">Fixed Salary:  <span id="grossSalary"> </span></div>

    <?php if ($rider_type == 'biker'): ?>
      <div class="possibleOilBill bg_aqua">
          Oil Bill:  <span id="possibleOilBill"><?= htmlspecialchars($user_data['oil_cost']) ?></span> (Possible)
      </div>
    <?php endif; ?>

    
    <div class="estimetTotal bg_aqua black">Estimated Total:  <span id="estimatedTotal"> </span></div>
    <div class="comissionTotal gw">Comission Tk: <span id="comissiontk"> </span></div>
    <div class="salary gw">Salary:  <span id="salaryTk"> </span></div>

     <?php if($rider_type == 'biker'): ?>
        <div class='oilBill gw'>
            Oil Bill:  <span id='oilBill'> </span> 
        </div>
    <?php endif; ?>

  </div>

  <div class="container" id="finishedSalary">
    <h1>Total Salary: <span id="salaryTotal"></span> tk</h1>
  </div>
</div>
<br>



<!-- pass data by hidden -->
<input type="hidden" class="besic_salary" value="<?php echo $besic_salary ?>" >


<script type="text/javascript" src="index.js"></script>
<script>
  const icon = document.querySelector(".icon");
  const headerMenu = document.querySelector(".headerMenu");

  icon.addEventListener("click", () => {
    headerMenu.style.display = headerMenu.style.display === "block" ? "none" : "block";
  });

  const yearMonthData = <?php echo json_encode($yearMonthData); ?>;

  document.addEventListener("DOMContentLoaded", () => {
    const currentYearSpan = document.getElementById("currentYear");
    const monthDropdown = document.getElementById("monthDropdown");
    const prevBtn = document.getElementById("prevYearBtn");
    const nextBtn = document.getElementById("nextYearBtn");

    const years = Object.keys(yearMonthData).sort();
    let currentIndex = years.length - 1;

    function renderYear() {
      const year = years[currentIndex];
      currentYearSpan.textContent = ` ${year} `;
      monthDropdown.innerHTML = "";

      yearMonthData[year].forEach(month => {
        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = `index.php?year=${year}&month=${month}`;
        a.className = "dropdown-item";
        a.textContent = month;
        li.appendChild(a);
        monthDropdown.appendChild(li);
      });
    }

    function toggleDropdown() {
      if (monthDropdown.style.display === "block") {
        monthDropdown.style.display = "none";
      } else {
        monthDropdown.style.display = "block";
      }
    }

    prevBtn.addEventListener("click", () => {
      if (currentIndex > 0) {
        currentIndex--;
        renderYear();
        monthDropdown.style.display = "none"; // auto-close dropdown
      }
    });

    nextBtn.addEventListener("click", () => {
      if (currentIndex < years.length - 1) {
        currentIndex++;
        renderYear();
        monthDropdown.style.display = "none"; // auto-close dropdown
      }
    });

    currentYearSpan.addEventListener("click", toggleDropdown);
    currentYearSpan.addEventListener("mouseenter", toggleDropdown);

    monthDropdown.addEventListener("mouseleave", () => {
      monthDropdown.style.display = "none";
    });

    renderYear();
  });
</script>

</body>
</html>

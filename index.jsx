function calculateAll() {
  const tableBody = document.getElementById("data-table-body");
  const rows = tableBody.querySelectorAll("tr");
  
  let receivedTotal = 0;
  let totalDelivered = 0;
  let totalTk = 0;
  let holidayCount = 0;
  let highestDelivered = 0;
  let lowestDelivered = Infinity; // Initialize with a high value
  let highestDeliveredRow; // Store row for highest value
  let lowestDeliveredRow;
  let serialNumber = 1;
  let absent = 0;
  let date = new Date();
  let year = date.getFullYear(); // বর্তমান বছর
  let month = date.getMonth() + 1; // getMonth() 0-11 রিটার্ন করে, তাই +1 করা হয়েছে
  let daysInMonth = new Date(year, month, 0).getDate();// বর্তমান মাসে কত দিন আছে বের করা

  rows.forEach((row, index) => {
    const dateCell = row.querySelector("td:nth-child(1)");
  	const receivedQtyCell = row.querySelector("td:nth-child(2)");
    const deliveredCell = row.querySelector("td:nth-child(3)");
    const rateCell = row.querySelector("td:nth-child(4)");
    const totalCell = row.querySelector("td:nth-child(5)"); // Assuming dynamic total cell exists
	
	if (dateCell) {
	dateCell.textContent = String(serialNumber).padStart(2, "0");
	serialNumber++;
	}
	
	if (!deliveredCell || !rateCell || !totalCell) {
	// Handle missing data (optional)
	console.error("Missing data in a row!");
	return;
	}
	
	const date = dateCell.textContent;
	const received = String(receivedQtyCell.textContent);
    const delivered = parseInt(deliveredCell.textContent);
    const rate = parseInt(rateCell.textContent);
    const total = delivered * rate;
    totalCell.textContent = total.toFixed(0); // Display total with 0 decimal places

    totalDelivered += delivered;
    totalTk += total;
    if (received == "off day" || received == "Off day"){
   		 holidayCount++
    }
    
    if (received == "absent" || received == "Absent"){
    	absent++
    }
    
    if(delivered > 0){
    highestDelivered = Math.max(highestDelivered, delivered);
    lowestDelivered = Math.min(lowestDelivered, delivered);
    }
    // Update row references if current value is highest or lowest
    if (delivered === highestDelivered) {
    highestDeliveredRow = row;
    }
    if (delivered === lowestDelivered) {
    lowestDeliveredRow = row;
    }
    // Set cell color based on delivered value
    if (delivered === 40) {
    row.style.backgroundColor = "azure";
    } else if (delivered < 40 && delivered > 0 && received != "Extra") {
    row.style.backgroundColor = "lightblue";
    } else if (delivered > 40 && delivered > 0) {
    row.style.backgroundColor = "lightgreen";
    } else if (received == "off day" || received == "Off day") {
    row.style.backgroundColor = "green";
    row.style.color = "white";
    }else if (received == "absent" || received == "Absent") {
    row.style.backgroundColor = "red";
    }else if (received == "extra" || received == "Extra") {
    row.style.backgroundColor = "purple";
    row.style.color = "white";
    dateCell.textContent = "#";
    	if(delivered == 0 ){
    		row.style.display = "none";
    	}
    }
    
    
    if (isNaN(receivedQtyCell.textContent) || isNaN(parseFloat(receivedQtyCell.textContent))) {
    receivedQty = 0;
    receivedQtyCell.textContent = receivedQtyCell.textContent; // Keep the original text content
    } else {
    receivedQty = parseInt(receivedQtyCell.textContent);
    receivedQtyCell.textContent = receivedQty.toFixed(0); // Display total with 2 decimal places
    }
    receivedTotal += receivedQty;
  });

  // Update totals
  document.getElementById('totalTk').innerHTML = totalTk;
  document.getElementById("rcvdTotal").textContent = receivedTotal;
  document.getElementById("dlvrdTotal").textContent = totalDelivered;
  const returnTotal = receivedTotal - totalDelivered;
  const returnRate = (returnTotal / receivedTotal) * 100;
  const deliveredRate = 100 - returnRate;
  document.getElementById("returnTotal").textContent = returnTotal;
  document.getElementById("dlvrdRate").textContent = deliveredRate.toFixed(1);
  document.getElementById("returnRate").textContent = returnRate.toFixed(1);
  

  // Calculate and display remaining values (assuming logic is the same)
  const totalDay = rows.length;
  const offDay = holidayCount;
  const workDay = totalDay - offDay - absent;
  const possibleDay = daysInMonth - 4;
  let totalWorkDay = possibleDay - absent;
  if(offDay > 4){
  	totalWorkDay = totalWorkDay - offDay + 4;
  }
  if(workDay <= totalWorkDay){
  totalWorkDay = totalWorkDay;	
  }else{
  totalWorkDay = workDay;
  }
  const avarDel = (totalDelivered / workDay).toFixed(2);
  const avarTk = (totalTk / workDay).toFixed(0);
  const grossSalary = 8000 - (absent * 258);
  const possibleIncome = avarTk * totalWorkDay;
  const estimatedTotal = possibleIncome + grossSalary;
  const possibleTotal = (avarDel * totalWorkDay).toFixed(0);
  
  document.getElementById('posiTotal').innerHTML = possibleTotal;
  document.getElementById('totalDay').innerHTML = totalDay;
  document.getElementById('offDay').innerHTML = offDay;
  document.getElementById('absent').innerHTML = absent;
  const absentRow = document.getElementById("absentRow");
  if(absent == 0){
  	absentRow.style.display = "none";
  }
  document.getElementById('totalWrkDay').innerHTML = workDay;
  document.getElementById('possibleTotalWrkDay').innerHTML = totalWorkDay;
  document.getElementById('avarDel').innerHTML = avarDel;
  document.getElementById('highDel').innerHTML = highestDelivered;//Highest Number in deliveredCell;
  document.getElementById('lowDel').innerHTML = String(lowestDelivered).padStart(2, "0");//Lowest number in deliveredCell;
  if (highestDeliveredRow) {
  highestDeliveredRow.style.backgroundColor = "Aqua";
  }
  if (lowestDeliveredRow) {
  lowestDeliveredRow.style.backgroundColor = "royalblue";
  }
  
  document.getElementById('avarTk').innerHTML = avarTk;
  
  document.getElementById('grossSalary').innerHTML = grossSalary;
  document.getElementById('possibleIncome').innerHTML = possibleIncome;
  document.getElementById('estimatedTotal').innerHTML = estimatedTotal;
  let salary = 258 * workDay;
  let salaryTotal = totalTk + (258 * workDay);

  if(totalDay >= 28){
      const commission = totalTk;
      salary = 8000 - (absent * 258);
      salaryTotal = salary + commission;
  }
  document.getElementById('salaryTk').innerHTML = salary;
  document.getElementById('salaryTotal').innerHTML = salaryTotal;
  document.getElementById('avarageTotalTk').innerHTML = (salaryTotal / totalDay).toFixed(0);
}

// Call the function to calculate everything on page load
window.addEventListener("load", calculateAll);
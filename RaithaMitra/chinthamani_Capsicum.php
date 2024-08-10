<?php

$dataPoints = array(
    array("x"=> 10, "y"=> 41),
    array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
    array("x"=> 30, "y"=> 50),
    array("x"=> 40, "y"=> 45),
    array("x"=> 50, "y"=> 52),
    array("x"=> 60, "y"=> 68),
    array("x"=> 70, "y"=> 38),
    array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
    array("x"=> 90, "y"=> 52),
    array("x"=> 100, "y"=> 60),
    array("x"=> 110, "y"=> 36),
    array("x"=> 120, "y"=> 49),
    array("x"=> 130, "y"=> 41)
);

?>
<!DOCTYPE HTML>
<html>
<head>  
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        height: 100vh;
        background: linear-gradient(to right, #ece9e6, #ffffff), url('https://wallpaperaccess.com/full/4893732.jpg'); /* Gradient and image */
        background-size: cover;
        background-position: center;
    }
    .nav-tabs {
        display: flex;
        justify-content: space-around;
        background-color: #007bff;
        border-radius: 8px 8px 0 0;
        padding: 14px 0;
        overflow: hidden;
    }
    .nav-tabs a {
        flex: 1;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .nav-tabs a:hover {
        background-color: #0056b3;
    }
    .field {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .field label {
        width: 120px;
        margin-right: 10px;
    }
    .field input[type="text"],
    .field input[type="date"],
    .field select {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 200px;
        transition: border-color 0.3s;
    }
    .field input[type="text"]:focus,
    .field input[type="date"]:focus,
    .field select:focus {
        outline: none;
        border-color: #007bff;
    }
    .calculate-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .calculate-btn:hover {
        background-color: #0056b3;
    }
    .container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        height: calc(100% - 60px); /* Adjusted to account for the height of the nav-tabs */
        width: 100%;
        gap: 10px;
        padding: 20px;
    }
    .upper-half, .lower-left, .lower-right {
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }
    .upper-half {
        grid-column: 1 / 3;
        grid-row: 1 / 2;
        flex-direction: column;
    }
    .lower-left {
        grid-column: 1 / 2;
        grid-row: 2 / 3;
    }
    .lower-right {
        grid-column: 2 / 3;
        grid-row: 2 / 3;
    }
    #chartContainer {
        height: 100%;
        width: 100%;
    }
    table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border: 1px solid #ddd; /* Add border to the table */
}

table th,
table td {
    border: 1px solid #ddd; /* Add border to table header and cells */
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

</style>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    theme: "light1", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "Market Price"
    },
    axisY:{
        includeZero: true
    },
    data: [{
        type: "column", //change type to bar, line, area, pie, etc
        //indexLabel: "{y}", //Shows y value on all Data Points
        indexLabelFontColor: "#5A5757",
        indexLabelPlacement: "outside",   
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();

// Add event listener to the chart container for click event
document.getElementById("chartContainer").addEventListener("click", function() {
    // Navigate to graph.php
    window.location.href = "graph.php";
});

}

function calculate() {
    const market = document.getElementById('market').value;
    const acres = document.getElementById('acres').value;
    const date = document.getElementById('date').value;
    
    const formData = new FormData();
    formData.append('market', market);
    formData.append('acres', acres);
    formData.append('date', date);

    fetch('calculate.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(`Calculated Value: ${data.calculated_value}`);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
}


    function fetchData() {
        const formData = new FormData();
        formData.append('crop', 'sugarcane');

        fetch('fetch_data.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            displayTable(data);
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
    }

function displayTable(data) {
    let table = document.getElementById('data-table');
    table.innerHTML = ''; // Clear existing table contents

    let headerRow = document.createElement('tr');
    let headers = ['Market', 'Date', 'Month', 'Quantity'];
    headers.forEach(headerText => {
        let th = document.createElement('th');
        th.textContent = headerText;
        headerRow.appendChild(th);
    });
    table.appendChild(headerRow);

    data.forEach(rowData => {
        let row = document.createElement('tr');
        Object.values(rowData).forEach(value => {
            let cell = document.createElement('td');
            cell.textContent = value;
            row.appendChild(cell);
        });
        table.appendChild(row);
    });
}
</script>
</head>
<body>
<div class="nav-tabs">
<a href="#">Home</a>
<a href="#">About Us</a>
<a href="form.php">Crop_Registration</a>
</div>
<div class="container">
<div class="upper-half">
    <div class="field">
        <label for="market"><b>Market:</b></label>
        <select id="market" name="market">
            <option value="mysore">Mysore</option>
            <option value="mandya">Mandya</option>
        </select>
    </div>
    <div class="field">
        <label for="acres"><b>No of Acres:</b></label>
        <input type="text" id="acres" name="acres">
    </div>
    <div class="field">
        <label for="date"><b>Date:</b></label>
        <input type="date" id="date" name="date">
    </div>
    <button class="calculate-btn" onclick="calculate()">Calculate</button>
    <!-- Additional content for the upper half can go here -->
    
</div>
<div class="lower-left">
    <div id="chartContainer"></div>
</div>
<div class="lower-right">
    <!-- Additional content for the lower right half can go here -->
    <button class="fetch-btn" onclick="fetchData()">Fetch Data</button>
    <table id="data-table"></table>
</div>
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>



<?php
// Establish connection to MySQL database
$servername = "localhost"; // Change this to your MySQL server name
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "krishi_db"; // Change this to your MySQL database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch total quantity produced in Mysore for sugarcane
$mysore_sugarcane_query = "SELECT SUM(quantity) AS total_mysore_sugarcane_quantity FROM crop_price WHERE market='mysore' AND crop='sugarcane'";
$mysore_sugarcane_result = mysqli_query($conn, $mysore_sugarcane_query);
$mysore_sugarcane_row = mysqli_fetch_assoc($mysore_sugarcane_result);
$total_mysore_sugarcane_quantity = $mysore_sugarcane_row['total_mysore_sugarcane_quantity'];

// Fetch total quantity produced in Mysore for raagi
$mysore_raagi_query = "SELECT SUM(quantity) AS total_mysore_raagi_quantity FROM crop_price WHERE market='mysore' AND crop='raagi'";
$mysore_raagi_result = mysqli_query($conn, $mysore_raagi_query);
$mysore_raagi_row = mysqli_fetch_assoc($mysore_raagi_result);
$total_mysore_raagi_quantity = $mysore_raagi_row['total_mysore_raagi_quantity'];

// Fetch total quantity produced in Mandya for sugarcane
$mandya_sugarcane_query = "SELECT SUM(quantity) AS total_mandya_sugarcane_quantity FROM crop_price WHERE market='mandya' AND crop='sugarcane'";
$mandya_sugarcane_result = mysqli_query($conn, $mandya_sugarcane_query);
$mandya_sugarcane_row = mysqli_fetch_assoc($mandya_sugarcane_result);
$total_mandya_sugarcane_quantity = $mandya_sugarcane_row['total_mandya_sugarcane_quantity'];

// Fetch total quantity produced in Mandya for raagi
$mandya_raagi_query = "SELECT SUM(quantity) AS total_mandya_raagi_quantity FROM crop_price WHERE market='mandya' AND crop='raagi'";
$mandya_raagi_result = mysqli_query($conn, $mandya_raagi_query);
$mandya_raagi_row = mysqli_fetch_assoc($mandya_raagi_result);
$total_mandya_raagi_quantity = $mandya_raagi_row['total_mandya_raagi_quantity'];

// Output the quantities (for testing purposes)
// echo "Total sugarcane quantity produced in Mysore: " . $total_mysore_sugarcane_quantity . "<br>";
// echo "Total raagi quantity produced in Mysore: " . $total_mysore_raagi_quantity . "<br>";
// echo "Total sugarcane quantity produced in Mandya: " . $total_mandya_sugarcane_quantity . "<br>";
// echo "Total raagi quantity produced in Mandya: " . $total_mandya_raagi_quantity . "<br>";

// $sugar_cane_per_man = ($total_mysore_sugarcane_quantity / 10000) ;
// $req_ent_sc_man_db = (340 / $sugar_cane_per_man) ;
// $tol_price_per_acre_man = $req_ent_sc_man_db * 1000;

// echo "Total price a farmer gets when he sells his yeild of sugar cane per acre in Mysore Market : " . $tol_price_per_acre_man  . "<br>";

// Close the connection
mysqli_close($conn);
?>

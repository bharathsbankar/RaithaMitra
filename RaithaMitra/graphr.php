<?php

$link = mysqli_connect("localhost", "root", "", "krishi_db");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$ma1 = array();

$ms1 = mysqli_query($link, "SELECT SUM(price) as price FROM crop_price WHERE crop='raagi' AND market='mysore' AND month < 7");
$count = 0;
$row1 = mysqli_fetch_array($ms1);
$ma1[$count]["y"] = $row1["price"];
$ma1[$count]["label"] = "m1";

$count = 1;
$ms2 = mysqli_query($link, "SELECT SUM(price) as price FROM crop_price WHERE crop='raagi' AND market='mandya' AND month > 6");
$row2 = mysqli_fetch_array($ms2);
$ma1[$count]["y"] = $row2["price"];
$ma1[$count]["label"] = "m1";

$ma2 = array();

$ms3 = mysqli_query($link, "SELECT SUM(price) as price FROM crop_price WHERE crop='raagi' AND market='mysore' AND month < 7");
$count = 0;
$row3 = mysqli_fetch_array($ms3);
$ma2[$count]["y"] = $row3["price"];
$ma2[$count]["label"] = "october";

$count = 1;
$ms4 = mysqli_query($link, "SELECT SUM(price) as price FROM crop_price WHERE crop='raagi' AND market='mandya' AND month >  6");
$row4 = mysqli_fetch_array($ms4);
$ma2[$count]["y"] = $row4["price"];
$ma2[$count]["label"] = "november";

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
   /* title:{
        text: "Average Amount Spent on Real and Artificial X-Mas Trees in U.S."
    },*/
    axisY:{
        includeZero: true
    },
    legend:{
        cursor: "pointer",
        verticalAlign: "center",
        horizontalAlign: "right",
        itemclick: toggleDataSeries
    },
    data: [{
        type: "column",
        name: "mysore",
        indexLabel: "{y}",
        yValueFormatString: "#0.##",
        showInLegend: true,
        dataPoints: <?php echo json_encode($ma1, JSON_NUMERIC_CHECK); ?>
    },{
        type: "column",
        name: "mandya",
        indexLabel: "{y}",
        yValueFormatString: "#0.##",
        showInLegend: true,
        dataPoints: <?php echo json_encode($ma2, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();

function toggleDataSeries(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    }
    else{
        e.dataSeries.visible = true;
    }
    chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
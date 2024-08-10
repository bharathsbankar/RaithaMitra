<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "krishi_db";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crop = $_POST['crop'];

    // Establish connection to MySQL database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "
        SELECT market, DATE_FORMAT(date, '%Y-%m-%d') AS date, DATE_FORMAT(date, '%M') AS month, SUM(quantity) AS quantity 
        FROM crop_price 
        WHERE crop = 'sugarcane' 
        GROUP BY market, DATE_FORMAT(date, '%Y-%m')
        ORDER BY market, DATE_FORMAT(date, '%Y-%m')
    ";

    $result = $conn->query($query);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $conn->close();

    echo json_encode($data);
}
?>

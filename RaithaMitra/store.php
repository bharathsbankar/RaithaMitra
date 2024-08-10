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


// Handle form submission
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $location = $_POST['location']; // Corrected column name
    $surveynumber = $_POST['surveynumber'];
    $crop = $_POST['crop'];
    $acers = $_POST['acers'];
    $market = $_POST['market'];
    $date = $_POST['date'];
    $month = date('m', strtotime($date));

    // Insert data into the database
    $sql_query = "INSERT INTO crop_price (name, location, surveynumber, crop, acers, market, date,month) 
    VALUES ('$name', '$location', '$surveynumber', '$crop', '$acers', '$market', '$date',$month)";

    if (mysqli_query($conn, $sql_query)) {
        // Redirect to KYM.html after successful insertion
        header("Location: KYM.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

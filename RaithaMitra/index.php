<?php
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Default username for MySQL in XAMPP is 'root'
$password = ""; // Default password for MySQL in XAMPP is blank
$database = "krishi_db"; // Replace 'your_database_name' with the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

// Perform SQL queries, insert/update/select data, etc. here...

// Close connection
$conn->close();
?>

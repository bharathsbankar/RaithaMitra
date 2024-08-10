<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "krishi_db";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $market = $_POST['market'];
    $acres = $_POST['acres'];
    $date = $_POST['date'];

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $calculated_value = 0;

    if ($market == 'mysore') {
        $mysore_sugarcane_query = "SELECT SUM(quantity) AS total_mysore_sugarcane_quantity FROM crop_price WHERE market='mysore' AND crop='sugarcane'";
        $mysore_sugarcane_result = mysqli_query($conn, $mysore_sugarcane_query);
        $mysore_sugarcane_row = mysqli_fetch_assoc($mysore_sugarcane_result);
        $total_mysore_sugarcane_quantity = $mysore_sugarcane_row['total_mysore_sugarcane_quantity'];

        if ($total_mysore_sugarcane_quantity > 0) {
            $sugar_cane_per_man = ($total_mysore_sugarcane_quantity / 10000);
            $req_ent_sc_man_db = (340 / $sugar_cane_per_man);
            $calculated_value = $req_ent_sc_man_db * 1000;
        } else {
            $calculated_value = "N/A"; // Handle the case where the quantity is zero
        }
    } elseif ($market == 'mandya') {
        // Similar calculation for Mandya
        $mandya_sugarcane_query = "SELECT SUM(quantity) AS total_mandya_sugarcane_quantity FROM crop_price WHERE market='mandya' AND crop='sugarcane'";
        $mandya_sugarcane_result = mysqli_query($conn, $mandya_sugarcane_query);
        $mandya_sugarcane_row = mysqli_fetch_assoc($mandya_sugarcane_result);
        $total_mandya_sugarcane_quantity = $mandya_sugarcane_row['total_mandya_sugarcane_quantity'];

        if ($total_mandya_sugarcane_quantity > 0) {
            $sugar_cane_per_man = ($total_mandya_sugarcane_quantity / 10000);
            $req_ent_sc_man_db = (340 / $sugar_cane_per_man);
            $calculated_value = $req_ent_sc_man_db * 1000;
        } else {
            $calculated_value = "N/A"; // Handle the case where the quantity is zero
        }
    }

    mysqli_close($conn);

    echo json_encode(['calculated_value' => $calculated_value]);
}
?>

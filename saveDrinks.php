<?php include("connection.php") ?>


<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if (!isset($_GET['user']) || !isset($_GET['drink'])) {
    echo ("Error, není nastaven user nebo drink");
    exit();
}

if (!is_numeric($_GET['user']) || !is_numeric($_GET['drink'])) {
    echo ("Error, nesprávné hodnoty");
    exit();
}

$sql = "INSERT INTO consumption(date, user_id, drinktype_id) VALUES ('" . date("Y-m-d") . "'," . $_GET['user'] . "," . $_GET['drink'] . ")";

if (mysqli_query($conn, $sql)) {
    echo("Přidáno!");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
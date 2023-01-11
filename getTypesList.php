<?php include("connection.php") ?>

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$output = array();

$sql = "SELECT id, name FROM drinktype";
$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
    array_push($output ,array($row['id'], $row['name']));
}

echo json_encode($output);
?>
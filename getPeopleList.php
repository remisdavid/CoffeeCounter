<?php include("connection.php") ?>

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$output = array();

$sql = "SELECT id, CONCAT(first_name, ' ', last_name) as name FROM user";
$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
    array_push($output ,array($row['id'], $row['name']));
}

echo json_encode($output);
?>
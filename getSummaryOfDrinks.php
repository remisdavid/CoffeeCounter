<?php include("connection.php") ?>


<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$filter = "WHERE 1=1 ";

if (isset($_GET['user'])) {
    if (is_numeric($_GET['user'])) {
        $filter .= " AND user_id = " . $_GET['user'];
    }
}

$datefilter = "";

if (isset($_GET['from'])) {
    if (is_numeric($_GET['from'])) {
        $datefilter .= " AND c.date > " . $_GET['from'];
    }
}

if (isset($_GET['to'])) {
    if (is_numeric($_GET['to'])) {
        $datefilter .= " AND c.date < " . $_GET['to'];
    }
}

$output = array();

$sql = "SELECT concat(u.first_name, ' ', u.last_name) as user, d.name as drinktype, consumption, ROUND(if(d.is_coffee, ((d.size * consumption) * 0.3), ((d.size * consumption) * 0.002)), 1) as price
FROM (
    SELECT user_id ,drinktype_id, COUNT(ID) as consumption
    FROM consumption as c
    WHERE 1=1 " . $datefilter ."
    GROUP BY user_id, drinktype_id
) as tmp
LEFT JOIN user as u ON u.ID = tmp.user_id
LEFT JOIN drinktype as d ON d.ID = tmp.drinktype_id
". $filter ."
ORDER BY user_id, consumption DESC";

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
    array_push($output ,array($row['user'], $row['drinktype'], $row['consumption']));
}

echo json_encode($output);
?>
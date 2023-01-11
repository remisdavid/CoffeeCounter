<?php include("connection.php") ?>


<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$filter = "";

if (isset($_GET['user'])) {
    if (is_numeric($_GET['user'])) {
        $filter .= " AND user_id = " . $_GET['user'];
    }
} else {
    echo ("Error-není zadaný uživatel");
    exit();
}

$output = array();

$sql = "SELECT ROUND(sum(price), 1) as price
FROM(
    SELECT user_id, (COUNT(c.ID) * d.size) * 0.3 as price
    FROM consumption as c
    INNER JOIN drinktype as d ON d.ID = c.drinktype_id AND d.is_coffee = 1
    GROUP BY user_id, drinktype_id
    
    UNION
    
    SELECT user_id, (COUNT(c.ID) * d.size) * 0.002 as price
    FROM consumption as c
    INNER JOIN drinktype as d ON d.ID = c.drinktype_id AND d.is_coffee = 0
    GROUP BY user_id, drinktype_id
) as tmp
WHERE 1=1 " . $filter;

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
    array_push($output ,$row['price']);
}

echo json_encode($output);
?>
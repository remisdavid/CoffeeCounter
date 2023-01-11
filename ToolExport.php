<?php include('connection.php') ?>

<?php
if (!$_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}

?>

<?php

$filter = "WHERE 1=1";

if (isset($_POST['user'])){
    if (is_numeric($_POST['user'])) {
        $filter .= ' AND user_id = '. $_POST['user'];
    }
}

if (isset($_POST['drink'])){
    if (is_numeric($_POST['drink'])) {
        $filter .= ' AND drinktype_id = '. $_POST['drink'];
    }
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=data.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array_values(array('Uživatel', 'Nápoj', 'Počet', 'Cena')), ';', ' ');

$sql = "SELECT concat(u.first_name, ' ', u.last_name) as user, d.name as drinktype, consumption, ROUND(if(d.is_coffee, ((d.size * consumption) * 0.3), ((d.size * consumption) * 0.002)), 1) as price
FROM (
    SELECT user_id ,drinktype_id, COUNT(ID) as consumption
    FROM consumption as c
    GROUP BY user_id, drinktype_id
) as tmp
LEFT JOIN user as u ON u.ID = tmp.user_id
LEFT JOIN drinktype as d ON d.ID = tmp.drinktype_id
" . $filter . "
ORDER BY user_id, consumption DESC";

$query = $conn->query($sql);
while ($row = $query->fetch_assoc()) {
    fputcsv($output, array_values(array($row['user'], $row['drinktype'], $row['consumption'], $row['price'])),';', ' ');
}
fclose($output);

?>
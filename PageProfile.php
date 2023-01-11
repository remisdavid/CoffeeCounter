<?php include("connection.php") ?>

<?php
if (!$_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("FragmentHead.php") ?>
</head>

<body>
    <?php include("FragmentNavigation.php") ?>

    <div class="container text-center p-3">
        
        <div class="row p-3">
            <div class="col-md-6">
                <h1>Co jste pili za posledních 30 dní</h1>
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Nápoj</th>
                            <th scope="col">Počet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT d.name, COUNT(c.ID) as consumption
                        FROM consumption as c
                        LEFT JOIN drinktype as d ON d.ID = c.drinktype_id
                        WHERE user_id = " . $_SESSION['user_id'] . "
                        GROUP BY user_id, drinktype_id";

                        $query = $conn->query($sql);


                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo ($row["name"]) ?>
                                </td>
                                <td>
                                    <?php echo ($row["consumption"]) ?>
                                </td>


                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h1>Stálo vás to</h1>

                        <?php

                        $sql = "SELECT sum(price) as price
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
                        WHERE user_id = " . $_SESSION['user_id'];

                        $query = $conn->query($sql);

                        while ($row = $query->fetch_assoc()) {
                            echo ("<h3>" . $row['price'] . "</h3>");
                            
                            
                        }
                        
                    ?>
            </div>
        </div>
</body>

</html>
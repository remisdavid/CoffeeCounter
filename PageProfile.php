<?php include("connection.php") ?>

<?php
if (!$_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}

?>

<?php
$filter = "";
if(isset($_POST['user'])){
    if (is_numeric($_POST['user'])) {
        $filter = "AND user_id = " . $_POST['user'];
    }
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
                <?php
                if ($_SESSION['user_permission_level'] == 1) {
                    ?>
                    <form action="PageProfile.php" method="post">
                        <div class="rom">
                            <div class="col-md"> 
                                <label for="user">Uživatel</label>
                                <select class="form-select" id="user" name="user" aria-label="Vyberte uživatele">
                                    <option selected>Vyberte uživatele</option>
                                    <?php

                                    $sql = "SELECT id, first_name, last_name FROM user";
                                    $query = $conn->query($sql);
                                    while ($row = $query->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo ($row["id"]) ?>">
                                            <?php echo ($row["first_name"] . " " . $row["last_name"]) ?>
                                        </option>
                                        <?php
                                    }

                                    ?>
                                </select>

                            </div>
                            <div class="col-md">
                                <input class="btn btn-primary" type="submit" value="Zobrazit">
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>

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
                        WHERE 1=1 " . $filter . " AND c.date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
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

                $sql = "SELECT ROUND(sum(price), 1) as price
                        FROM(
                            SELECT user_id, (COUNT(c.ID) * d.size) * 0.3 as price
                            FROM consumption as c
                            INNER JOIN drinktype as d ON d.ID = c.drinktype_id AND d.is_coffee = 1
                            WHERE c.date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                            GROUP BY user_id, drinktype_id
                            
                            UNION
                            
                            SELECT user_id, (COUNT(c.ID) * d.size) * 0.002 as price
                            FROM consumption as c
                            INNER JOIN drinktype as d ON d.ID = c.drinktype_id AND d.is_coffee = 0
                            WHERE c.date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
                            GROUP BY user_id, drinktype_id
                        ) as tmp
                        WHERE 1=1 " . $filter;

                $query = $conn->query($sql);

                while ($row = $query->fetch_assoc()) {
                    echo ("<h3>" . $row['price'] . " Kč</h3>");


                }

                ?>
            </div>
        </div>
</body>

</html>
<?php include("connection.php") ?>

<?php
if (!$_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}

?>

<?php

$filter = 'WHERE 1=1';

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

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("FragmentHead.php") ?>
</head>

<body>
    <?php include("FragmentNavigation.php") ?>

    <div class="container text-center p-3">
        <h1>Přehled</h1>
        <form action="PageSummary.php" method="post">
            <div class="row p-3">
                <div class="col-md-4">

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
                <div class="col-md-4">

                    <select class="form-select" id="drink" name="drink" aria-label="Vyberte nápoj">
                        <option selected>Vyberte nápoj</option>
                        <?php

                        $sql = "SELECT id, name FROM drinktype";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <option value="<?php echo ($row["id"]) ?>">
                                <?php echo ($row["name"]) ?>
                            </option>
                            <?php
                        }

                        ?>
                    </select>

                </div>
                <div class="col-md">
                    <input class="btn btn-primary" type="submit" value="Filtrovat">
                    <a href="ToolSummaryReset.php" role="button" class="btn btn-outline-secondary">Resetovat</a>
                </div>
            </div>
        </form>

        <div class="row p-3">
            <div class="col-md">

                <table class="table table-striped table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Uživatel</th>
                            <th scope="col">Nápoj</th>
                            <th scope="col">Počet</th>
                            <th scope="col">Cena</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT concat(u.first_name, ' ', u.last_name) as user, d.name as drinktype, consumption, ROUND(if(d.is_coffee, ((d.size * consumption) * 0.3), ((d.size * consumption) * 0.002)), 1) as price
                            FROM (
                                SELECT user_id ,drinktype_id, COUNT(ID) as consumption
                                FROM consumption as c
                                GROUP BY user_id, drinktype_id
                            ) as tmp
                            LEFT JOIN user as u ON u.ID = tmp.user_id
                            LEFT JOIN drinktype as d ON d.ID = tmp.drinktype_id
                            ". $filter ."
                            ORDER BY user_id, consumption DESC";

                        $query = $conn->query($sql);


                        while ($row = $query -> fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo ($row["user"]) ?></td>
                                <td>
                                    <?php echo ($row["drinktype"]) ?>
                                </td>
                                <td><?php echo ($row["consumption"]) ?></td>
                                <td>
                                    <?php echo ($row["price"]) ?> Kč
                                </td>

                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
</body>

</html>
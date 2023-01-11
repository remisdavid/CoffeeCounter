<?php include("connection.php") ?>

<?php
if (!$_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}

?>

<?php

if (isset($_POST['drink']) && isset($_POST['amount']) && isset($_POST['cost'])) {
    if (is_numeric($_POST['drink']) && is_numeric($_POST['amount']) && is_numeric($_POST['cost']) ) {
        $sql = "INSERT INTO stock (user_id, drinktype_id, amount, cost) VALUES (" . $_SESSION['user_id'] . ", " . $_POST['drink'] . ", " . $_POST['amount'] . ", " . $_POST['cost'] . ")";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["msg"] = "Přidáno!";
            header('Location: PageStock.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    } else {
        $error = "Musíte vyplnit všechna pole!";
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

    <div class="position-absolute top-50 start-50 translate-middle">
        <h1>Koupil jsem</h1>
        <form action="PageStock.php" method="post" class="row gap-3">
            <div class="row">
                <?php

                if (isset($_SESSION["msg"])) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo ($_SESSION["msg"]);
                        unset($_SESSION["msg"]);
                        ?>
                    </div>
                    <?php
                } elseif (isset($error)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo ($error); ?>
                    </div>
                    <?php
                }

                ?>
            </div>
            <div class="row">

                <div class="col-md-4">

                    <label for="drink" class="form-label">Typ nápoje</label>
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

                <div class="col-md-4">
                    <label for="amount" class="form-label">Velikost dávky</label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="15 g/ml">
                </div>

                <div class="col-md-4">
                    <label for="cost" class="form-label">Cena</label>
                    <input type="number" class="form-control" id="cost" name="cost" placeholder="100 Kč">
                </div>

            </div>
            <div class="row">
                <div class="col-md">
                    <input class="btn btn-primary" type="submit" value="Uložit">
                </div>
            </div>
        </form>

    </div>
</body>

</html>
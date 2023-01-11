<?php include("connection.php") ?>

<?php
if (!$_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['user_permission_level'] != 1){
    header('Location: index.php');
    exit();
}

?>

<?php

if (isset($_POST['drink']) && isset($_POST['portion'])) {
    if (is_numeric($_POST['drink']) && is_numeric($_POST['portion'])) {
        $sql = "UPDATE drinktype SET size = " . $_POST['portion'] . " WHERE id = ". $_POST['drink'];
        if (mysqli_query($conn, $sql)) {
            $_SESSION["msg"] = "Přidáno!";
            header('Location: PageDrink.php');
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
        <h1>Upravit nápoj</h1>
        <form action="PageDrink.php" method="post" class="row gap-3">
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
                <div class="col-md-6">

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

                <div class="col-md-6">
                    <label for="portion" class="form-label">Velikost dávky</label>
                    <input type="number" class="form-control" id="portion" name="portion" placeholder="15 g/ml">
                </div>

            </div>
            <div class="row">
                <div class="col-md">
                    <input class="btn btn-primary" type="submit" value="Aktualizovat">
                </div>
            </div>
        </form>

    </div>
</body>

</html>
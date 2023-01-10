<?php include("connection.php") ?>

<?php

if (isset($_POST['user']) && isset($_POST['drink'])) {

        if (is_numeric($_POST['user']) && is_numeric($_POST['drink'])) {
            $sql = "INSERT INTO consumption(date, user_id, drinktype_id) VALUES ('".date("Y-m-d")."'," . $_POST['user'] . "," . $_POST['drink'] . ")";
            if (mysqli_query($conn, $sql)) {
            $_SESSION["msg"] = "Přidáno!";
            header('Location: PageConsumption.php');
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
        <form action="PageConsumption.php" method="post" class="row gap-3">
            <div class="row">
                <?php
                    if(isset($_SESSION["msg"])){
                ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo ($_SESSION["msg"]);
                                unset($_SESSION["msg"]);
                            ?>
                        </div>
                <?php
                    }elseif (isset($error)) {
                ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo ($error);?>
                        </div>
                <?php
                    }
                ?>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <label for="user">Uživatel</label>
                    <select class="form-select" id="user" name="user" aria-label="Vyberte uživatele">
                        <option selected>Vyberte uživatele</option>
                        <?php

                        $sql = "SELECT id, first_name, last_name FROM user";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                                <option value="<?php echo($row["id"]) ?>"><?php echo($row["first_name"] . " " . $row["last_name"])?></option>
                            <?php
                        }

                        ?>
                    </select>

                </div>
                <div class="col-md-6">

                    <label for="drink">Typ nápoje</label>
                    <select class="form-select" id="drink" name="drink" aria-label="Vyberte nápoj">
                        <option selected>Vyberte nápoj</option>
                        <?php

                        $sql = "SELECT id, name FROM drinktype";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                                <option value="<?php echo($row["id"]) ?>"><?php echo($row["name"])?></option>
                            <?php
                        }

                        ?>
                    </select>

                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <input class="btn btn-primary" type="submit" value="Přidat">
                </div>
            </div>
        </form>

    </div>
</body>

</html>
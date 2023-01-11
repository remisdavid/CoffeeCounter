<?php include("connection.php") ?>

<?php


if ($_SESSION['logged_in']) {
    if ($_SESSION['logged_in']) {
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $sql = "SELECT id, username, password, first_name, last_name, role_id FROM user";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            if ($row["username"] == $_POST['username'] && $row["password"] == $_POST['password']) {
                $_SESSION['user_id'] = $row["id"];
                $_SESSION['user_first_name'] = $row["first_name"];
                $_SESSION['user_last_name'] = $row["last_name"];
                $_SESSION['user_permission_level'] = $row["role_id"];
                $_SESSION['logged_in'] = true;

                break;
            }
        }

        if ($_SESSION['logged_in']) {
            if ($_SESSION['logged_in']) {
                header('Location: index.php');
                exit;
            }
        } else {
            $msg = 'Špatné přihlašovací údaje';
        }

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
        <form action="PageLogin.php" method="post" class="row gap-3">
            <div class="row">
                <?php
                if (isset($msg)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo ($msg) ?>
                    </div>
                    <?php
                }
                ?>

            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Uživatelské jméno" value="">
                        <label for="username">Uživatelské jméno</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Heslo"
                            value="">
                        <label for="password">Heslo</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <input class="btn btn-primary" type="submit" value="Přihlásit se">
                </div>
            </div>
        </form>

    </div>
</body>

</html>
<?php
ob_start();
session_start();
?>
<?php

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($_POST['username'] == 'lm' && $_POST['password'] == 'test') {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = 'lm';

        header("Location: index.php");
        die();
    } else {
        $msg = 'Špatné údaje';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ?>

</head>

<body>

    <div class="position-absolute top-50 start-50 translate-middle">
        <form action="login.php" method="post" class="row gap-3">
            <div class="row">
                <?php
                    if(isset($msg)){
                ?>
                        <div class="alert alert-danger" role="alert">
                        <?php echo($msg)?>
                        </div>
                <?php
                    }
                    
                ?>
            
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Uživatelské jméno" value="">
                        <label for="username">Uživatelské jméno</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" name="password" class="form-control" id="password" placeholder="Heslo" value="">
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
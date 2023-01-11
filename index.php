<?php

session_start();

if ($_SESSION['logged_in']) {
    header('Location: PageConsumption.php');
} else {
    header('Location: PageLogin.php');
}

exit();
?>

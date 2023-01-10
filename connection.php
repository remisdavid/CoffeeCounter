<?php
    $servername = "localhost:3306";
    $username = "coffeeapp";
    $password = "kaficko1.";
    $db = "coffecounter";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Check connection
    if (!$conn) {
        echo ("Nepodařilo se připojit k databázi");
    }
    session_cache_expire(10);

    session_start();
?>
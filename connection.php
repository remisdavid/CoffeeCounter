<?php
    $servername = "sql6.webzdarma.cz:3306";
    $username = "remischytrak6489";
    $password = "hs^O00MT7#0#)-7d&,8G";
    $db = "remischytrak6489";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Check connection
    if (!$conn) {
        echo ("Nepodařilo se připojit k databázi");
    }
?>
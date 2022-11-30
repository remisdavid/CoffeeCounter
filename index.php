<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="app.js" defer></script>
</head>

<body>
    <nav class="main-navigation">
        <a class="logo" href="#">
            <svg width="32" height="32" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                <path d="M6 1v3"></path>
                <path d="M10 1v3"></path>
                <path d="M14 1v3"></path>
            </svg>
            <p>CoffeeCounter</p>
        </a>

        <ul class="navigation">
            <a href="#Home">
                <li class="nav-item">Domů</li>
            </a>
            <a href="#Add">
                <li class="nav-item">Přidat</li>
            </a>
            <a href="#Summary">
                <li class="nav-item">Přehled</li>
            </a>
        </ul>
    </nav>

    <main class="main-content">
        <section class="home" id="Home">
            <h1>CoffeCounter</h1>
            <p>Počítej kafe ...</p>
            <a href="#Add" class="btn">Začít</a>
        </section>

        <?php

        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $db = "coffecounter";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $db);

        // Check connection
        if (!$conn) {
            echo ("Nepodařilo se připoji k databázi");
        }

        $sql = "SELECT p.ID, p.name FROM people as p";
        $usersQuery = $conn->query($sql);

        function printUsersOption(mysqli_result $users)
        {
            while ($row = $users->fetch_assoc()) {
                echo "<option value=\"{$row["ID"]}\">{$row["name"]}</option>";
            }
        }

        $sql = "SELECT t.ID, t.typ FROM types as t";
        $types = array();
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $types[$row["ID"]] = $row["typ"];
        }

        function printTypesOption(array $types)
        {
            foreach($types as $id => $typ){
                echo "<option value=\"{$id}\">{$typ}</option>";
            }
        }


        ?>

        <section class="add" id="Add">
            <form id="AddCoffeForm" name="addCoffeForm" method="post">
                <span></span>
                <div class="inputContainer">
                    <label for="user">Osoba:</label>
                    <select name="user" id="FormUsers">
                        <option value="0">Vyberte osobu: </option>
                        <?php
                        printUsersOption($usersQuery);
                            ?>
                    </select>
                </div>
                <div class="inputContainer">
                    <label for="type">Typ nápoje:</label>
                    <select name="type" id="FormDrinks">
                        <option value="0">Vyberte nápoj: </option>
                        <?php
                        printTypesOption($types);
                            ?>
                    </select>
                </div>
                <input type="submit" value="Potvrdit">
            </form>
        </section>
        <section class="summary" id="Summary">
            <form action="index.php" method="post">
            <div class="summaryFilter">
                <div class="inputContainer">
                    <label for="summaryUser">Osoba:</label>
                    <select name="summaryUser" id="SummaryUser">
                        <option value="0">Vyberte osobu: </option>
                        <?php
                        printUsersOption($usersQuery);
                        ?>
                    </select>
                </div>
                <div class="inputContainer">
                    <label for="summaryDateFrom">Datum od:</label>
                    <input type="date" id="SummaryDateFrom" min="2000-01-01">
                </div>
                <div class="inputContainer">
                    <label for="summaryDateTo">Datum do:</label>
                    <input type="date" id="SummaryDateTo" max="2030-01-01">
                </div>

                <input type="submit" value="Filtrovat">
            </div>
            </form>
            <table id="SummaryTable">
                <thead>
                    <tr>
                        <th>Osoba</th>
                        <th>Název kávy</th>
                        <th>Počet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        if(!empty($_POST["summaryUser"])){
                            $userID = $_POST["summaryUser"];
                            echo("anshbdz");
                        }
                        
                        
                    } catch (\Throwable $th) {
                        
                    }


                    function printRow($user, $coffee_name, $amount)
                    {
                        echo ("<tr><td>{$user}</td><td>{$coffee_name}</td><td>{$amount}</td></tr>");
                    }

                    $sql = "SELECT p.name,t.typ, amount FROM (SELECT d.id_people,d.id_types,COUNT(ID) as amount from drinks as d GROUP BY d.id_people,d.id_types) as d INNER JOIN types as t on t.ID = d.id_types INNER JOIN people as p on p.ID = d.id_people ORDER BY p.name, amount DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            printRow($row["name"], $row["typ"], $row["amount"]);
                        }
                    }

                    ?>

                </tbody>

            </table>
        </section>
    </main>

</body>

</html>
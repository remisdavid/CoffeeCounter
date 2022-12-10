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

        $sql = "SELECT p.ID, p.name FROM people as p";
        $people = array();
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $people[$row["ID"]] = $row["name"];
        }

        $sql = "SELECT t.ID, t.typ FROM types as t";
        $types = array();
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $types[$row["ID"]] = $row["typ"];
        }

        function printUsersOption(array $users)
        {
            foreach ($users as $id => $name) {
                echo "<option value=\"{$id}\">{$name}</option>";
            }
        }

        function printTypesOption(array $types)
        {
            foreach ($types as $id => $typ) {
                echo "<option value=\"{$id}\">{$typ}</option>";
            }
        }


        ?>
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



        <section class="add" id="Add">
            <form id="AddCoffeForm" name="addCoffeForm" method="post">
                <span></span>
                <div class="inputContainer">
                    <label for="user">Osoba:</label>
                    <select name="user" id="FormUsers">
                        <option value="0">Vyberte osobu: </option>
                        <?php
                        printUsersOption($people);
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
                                printUsersOption($people);
                            ?>
                        </select>
                    </div>
                    <div class="inputContainer">
                        <label for="summaryDateFrom">Datum od:</label>
                        <input type="date" name="summaryDateFrom" id="SummaryDateFrom">
                    </div>
                    <div class="inputContainer">
                        <label for="summaryDateTo">Datum do:</label>
                        <input type="date" name="summaryDateTo" id="SummaryDateTo">
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
                        <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $conditions = "WHERE 1=1";

                        if (!empty($_POST["summaryUser"])) {
                            $userID = $_POST["summaryUser"];
                            $conditions .= " AND p.ID = " . $userID;
                        }

                        if (!empty($_POST["summaryDateFrom"])) {
                            $dateFrom = $_POST["summaryDateFrom"];
                            $conditions .= " AND d.date > '" . $dateFrom . "'";

                        }

                        if (!empty($_POST["summaryDateTo"])) {
                            $dateTo = $_POST["summaryDateTo"];
                            $conditions .= " AND d.date < '" . $dateTo . "'";

                        }

                    } catch (\Throwable $th) {

                    }


                    function printRow($user, $coffee_name, $amount,$cost)
                    {
                        echo ("<tr><td>{$user}</td><td>{$coffee_name}</td><td>{$amount}</td><td>{$cost}</td></tr>");
                    }
                    $sql = "SELECT p.name,t.typ, amount, (t.cost * amount) as cost FROM (SELECT d.id_people,d.id_types,ANY(COUNT(ID) as amount),ANY(d.date) from drinks as d GROUP BY d.id_people,d.id_types) as d INNER JOIN types as t on t.ID = d.id_types INNER JOIN people as p on p.ID = d.id_people {$conditions} ORDER BY p.name, amount DESC";
                    $query = $conn->query($sql);

                    while ($row = $query->fetch_assoc()) {
                        printRow($row["name"], $row["typ"], $row["amount"], $row["cost"]);
                    }

                    

                    ?>

                </tbody>

            </table>
        </section>
    </main>

</body>

</html>
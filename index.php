<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include("head.php")
    ?>
</head>

<body>
    <?php


/*      
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
*/

        ?>

    <?php 
        include("navigation.php")

    ?>

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
                            $conditions .= " AND d.id_people = " . $userID;
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
                    $sql = "SELECT p.name,t.typ, amount, (t.cost * amount) as cost FROM (SELECT d.id_people,d.id_types,COUNT(ID) as amount from drinks as d {$conditions} GROUP BY d.id_people,d.id_types) as d INNER JOIN types as t on t.ID = d.id_types INNER JOIN people as p on p.ID = d.id_people ORDER BY p.name, amount DESC";
                    
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
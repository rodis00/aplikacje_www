<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Adrian Sidor">
    <link rel="stylesheet" href="../css/store.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="../img/orange_favicon.ico" type="image/x-icon">
    <script src="./js/kolorujtlo.js" type="text/javascript"></script>
    <script src="../js/timedate.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Store</title>
</head>

<body onload="startClock()">

    <section id="store">
        <div id="clock">
            <div>
                <div id="zegarek"></div>
                <div id="data"></div>
            </div>
        </div>
        <a href="../php/koszyk.php">
            <div>Koszyk</div>
        </a>
        <a href="../index.php">
            <div>Home</div>
        </a>
        <div class="title">
            <h1>Cennik</h1>
        </div>
        <div id="price-list">
            <table>
                <tr>
                    <th>Produkt</th>
                    <th>Cena za kg</th>
                    <th>Dodaj do koszyka</th>
                </tr>
                <?php
                    session_start();
                    // Jeśli nie ma jeszcze utworzonej sesji koszyka, tworzy ją
                    if(!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }
                    // dodawanie id produktu do sesji koszyka
                    if(isset($_POST['add_to_cart'])) {
                        array_push($_SESSION['cart'], $_POST['product_id']);
                    }

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "moja_strona";

                    // Tworzenie połączenia
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Sprawdzenie połączenia
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 

                    $sql = "SELECT id, tytul, cena_netto, podatek_vat FROM produkty";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Wyciąganie danych z bazy
                        while($row = $result->fetch_assoc()) {
                            $cost = round(($row["cena_netto"] * ($row["podatek_vat"]/100)) + $row["cena_netto"], 2);
                            echo "<tr><td>" . $row["tytul"]. "</td><td class='price'>" .$cost. " zł</td><td>";
                            echo '<form method="post">';
                            echo '<input type="hidden" name="product_id" value="'.$row['id'].'">';
                            echo '<input type="submit" name="add_to_cart" value="Dodaj do koszyka">';
                            echo "</form></td></tr>";
                        }
                    } else {
                        echo "Brak produktów.";
                    }
                    $conn->close();
                ?>
            </table>
        </div>
    </section>
</body>
</html>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Adrian Sidor">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="../img/orange_favicon.ico" type="image/x-icon">
    <script src="../js/timedate.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Koszyk</title>
</head>
<body>
    <section id="cart">
        <a href="../php/store2.php">
            <div>Wróć</div>
        </a>
    <?php
        session_start();

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
        // Jeśli sesja koszyka jest ustawiona i nie jest pusta
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            if(isset($_POST['remove_from_cart'])) {
                $remove_id = $_POST['product_id'];
                if(($key = array_search($remove_id, $_SESSION['cart'])) !== false) {
                    unset($_SESSION['cart'][$key]);
                }
                header('Location: #');
                exit;
            }
            $quantity = array();
            // Jeśli produkt już jest w tablicy ilości, zwiększ jego ilość o 1
            foreach($_SESSION['cart'] as $product_id) {
                if(array_key_exists($product_id, $quantity)) {
                    $quantity[$product_id]++;
                } else {
                    // W przeciwnym razie, dodaj produkt do tablicy ilości z ilością 1
                    $quantity[$product_id] = 1;
                }
            }
            // Jeśli formularz usuwania produktu z koszyka został wysłany
            if(isset($_POST['remove_from_cart'])) {
                // Pobieranie ID produktu do usunięcia
                $remove_id = $_POST['product_id'];
                // Sprawdzanie czy produkt jest w koszyku i usuwanie go
                if(($key = array_search($remove_id, $_SESSION['cart'])) !== false) {
                    unset($_SESSION['cart'][$key]);
                }
            }

            echo "<h2>Produkty w koszyku</h2>";
            echo "<table>";
            echo "<tr><th>Produkt</th><th>Cena za kg</th><th>Ilość</th><th>Suma</th></tr>";
            $total = 0;
            foreach($quantity as $product_id => $qty) {
                $sql = "SELECT id, tytul, cena_netto, podatek_vat FROM produkty WHERE id = ".$product_id;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // obliczanie ceny z vat
                        $cost = round(($row["cena_netto"] * ($row["podatek_vat"]/100)) + $row["cena_netto"], 2);
                        $subtotal = $cost * $qty;
                        $total += $subtotal;
                        echo "<tr><td>" . $row["tytul"]. "</td><td class='price'>" . $cost. "zł</td><td>" . $qty. "</td><td>" .$subtotal. "zł</td>";
                        echo '<td><form method="post" action="#">';
                        echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
                        echo'<input type="submit" name="remove_from_cart" value="Usuń"></form></td></tr>';
                        }
                    }
            }
            echo "<tr><td colspan='3'>Razem:</td><td>" . $total . "zł</td></tr>";
            echo "</table>";
        } else {
        echo "<h2>Koszyk jest pusty</h2>";
        }
        $conn->close();
        ?>
    </section>
</body>
</html>
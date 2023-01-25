<?php
//  wyswietla formularz logowania do 
// panelu CMS
    function FormularzLogowania(){
        $wynik = '
            <div class="logowanie-1">
                <h1 class="heading">Panel CMS:</h1>
                <div class="logowanie">
                    <form method="POST" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
                        <table class="logowanie-2">
                            <tr><td class="log4_t"></td><td><input type="text" name="login_email" class="logowanie" placeholder="email"/></td></tr>
                            <tr><td class="log4_t"></td><td><input type="password" name="login_pass" class="logowanie" placeholder="password"/></td></tr>
                            <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="button" value="Zaloguj" /></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        ';
        return $wynik;
    }
// metoda wyswietlajaca formularz zarzadzania podstronami
// za pomoca tego formularza mozna usuwac/dodawac/editowac podstrony
    function EdytujPodstrone(){
        $wynik = '
            <div class="editForm">    
                <form method="POST" action="'.$_SERVER['REQUEST_URI'].'">
                    <h1>Edytuj stronę:</h1>
                    <input type="number" name="page_id" placeholder="Page ID"/>
                    <input type="text" name="page_title" placeholder="Page Title"/>
                    <label><input type="checkbox" name="page_active" class="checkbox">zaznacz jeśli strona ma być aktywna</label>
                    <textarea name="page_content" placeholder="Page Content" rows="15" cols="55"></textarea>
                    <div>
                        <div><input type="submit" value="edytuj" class="edit" name="btn-1" /></div>
                        <div><input type="submit" value="usuń" class="delete" name="btn-2" /></div>
                        <div><input type="submit" value="dodaj" class="add" name="btn-3" /></div>
                    </div>
                </form>
            </div>
        ';
        
        return $wynik;
    }
// metoda wyswietla wszystkie dostepne podstrony
// aplikacji www ktore znajduja sie w bazie danych
    function ListaPodstron($conn){
        $query = "SELECT * FROM page_list";
        $result = mysqli_query($conn, $query);
        echo '<table id="sites">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                </tr>';
        while($row = mysqli_fetch_array($result)){
            echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['page_title'].'</td>
                </tr>'; 
        }
        echo '</table>';
    }
    // metoda wyswietla wszystkie dostepne kategorie
    // aplikacji www ktore znajduja sie w bazie danych
    function Kategorie($conn){
        $query = "SELECT * FROM kategorie WHERE matka = '0'";
        $result = mysqli_query($conn, $query);
        echo '<table id="sites">
                <tr>
                    <th>ID</th>
                    <th>Kategoria</th>
                    <th>Nazwa</th>
                    <th>Podkategoria</th>
                </tr>';
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['matka'].'</td>
                    <td>'.$row['nazwa'].'</td>
                    <td id="podkategoria">';
 
            $subQuery = "SELECT * FROM kategorie WHERE matka='".$row['id']."'";
            $result2 = mysqli_query($conn, $subQuery);
            while ($row2 = mysqli_fetch_array($result2)){    
                echo $row2['id'].'. '.$row2['nazwa'].'<br>';
            }
        }echo '</td></tr></table>';
    }
    // metoda wyswietlajaca formularz zarzadzania kategoriami
    // za pomoca tego formularza mozna usuwac/dodawac/editowac kategorie
    function ZarzadzajKategoriami(){
        $wynik = '
            <div class="editForm">    
                <form method="POST" action="'.$_SERVER['REQUEST_URI'].'">
                    <h1>Edytuj Kategorie:</h1>
                    <input type="number" name="id" placeholder="ID"/>
                    <input type="number" name="matka" placeholder="Kategoria ID"/>
                    <input type="text" name="nazwa" placeholder="Nazwa"/>
                    <div>
                        <div><input type="submit" value="edytuj" class="edit" name="edit-category" /></div>
                        <div><input type="submit" value="usuń" class="delete" name="delete-category" /></div>
                        <div><input type="submit" value="dodaj" class="add" name="add-category" /></div>
                    </div>
                </form>
            </div>
        ';
        
        return $wynik;
    }
    // metoda wyswietla wszystkie dostepne produkty
    // aplikacji www ktore znajduja sie w bazie danych
    function Produkty($conn){
        $query = "SELECT * from produkty";
        $result = mysqli_query($conn, $query);
        echo '<table id="products">
                <tr>
                    <th>ID</th>
                    <th>Tytul</th>
                    <th>Opis</th>
                    <th>Data utworzenia</th>
                    <th>Data modyfikacji</th>
                    <th>Data wygaśnięcia</th>
                    <th>Cena netto</th>
                    <th>Vat %</th>
                    <th>Ilość kg</th>
                    <th>Status</th>
                    <th>Kategoria</th>
                    <th>Gabaryt</th>
                    <th>Zdjęcie</th>
                </tr>';
        while($row = mysqli_fetch_array($result)){
            echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['tytul'].'</td>
                    <td><textarea class="description">'.$row['opis'].'</textarea></td>
                    <td>'.$row['data_utworzenia'].'</td>
                    <td>'.$row['data_modyfikacji'].'</td>
                    <td>'.$row['data_wygasniecia'].'</td>
                    <td>'.$row['cena_netto'].'</td>
                    <td>'.$row['podatek_vat'].'</td>
                    <td>'.$row['ilosc'].'</td>
                    <td>'.$row['status'].'</td>
                    <td>'.$row['kategoria'].'</td>
                    <td>'.$row['gabaryt_produktu'].'</td>
                    <td><img class="image" src="data:image/jpeg;base64,'.base64_encode($row['zdjecie']).'"/></td>
                </tr>'; 
        }
        echo '</table>';
    }
    // metoda wyswietlajaca formularz zarzadzania produktami
// za pomoca tego formularza mozna usuwac/dodawac/editowac produkty
    function ZarzadzajProduktami(){
        $wynik = '
            <div class="editForm">    
                <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
                    <h1>Edytuj Produkty:</h1>
                    <input type="number" name="id" placeholder="ID"/>
                    <input type="text" name="tytul" placeholder="Tytuł"/>
                    <textarea name="opis" placeholder="Opis" rows="15" cols="55"></textarea>
                    <p class="date">Data wygaśnięcia:</p>
                    <input type="datetime-local" name="data_wygasniecia"/>
                    <input type="number" name="cena_netto" step="any" placeholder="Cena netto"/>
                    <input type="number" name="vat" placeholder="Vat"/>
                    <input type="number" name="ilosc" placeholder="Ilość"/>
                    <label><input type="checkbox" name="status" class="checkbox">zaznacz jeśli status ma być aktywny</label>
                    <input type="number" name="kategoria" placeholder="Kategoria"/>
                    <input type="text" name="gabaryt" placeholder="Gabaryt"/>
                    <input type="file" name="zdjecie"/>
                    <div>
                        <div><input type="submit" value="edytuj" class="edit" name="edit-product" /></div>
                        <div><input type="submit" value="usuń" class="delete" name="delete-product" /></div>
                        <div><input type="submit" value="dodaj" class="add" name="add-product" /></div>
                    </div>
                </form>
            </div>
        ';
        
        return $wynik;
    }
?>


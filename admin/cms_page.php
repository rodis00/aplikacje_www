<?php 
    session_start(); 
    if (!isset($_SESSION['zalogowany'])){  
        header('Location: admin_site.php');
        exit();
    }
    require_once('admin.php');
    require_once('../cfg.php');
    
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cms_page.css">
    <title>CMS Admin Page</title>
</head>
<body>
    <?php 
        ob_start();
        // wyswietlenie podstron z bazy danych
        $user = $_SESSION['user'];
        echo '<p id="welcome-user">'.$user.'</p>';
        echo ListaPodstron(mysqli_connect($dbhost, $dbuser, $dbpass, $baza));
        echo '<a href="logout.php" id="logout_btn"> Wyloguj się</a>';
        // wyswietlenie formularza edycji podstron
        // za pomoca ktorego mozna dodawac/usuwac/modyfikowac
        // podstrony aplikacji
        echo EdytujPodstrone();

        // wyswietlanie kategorii i podkategorii
        Kategorie(mysqli_connect($dbhost, $dbuser, $dbpass, $baza));
        // zarzadzanie kategoriami
        echo ZarzadzajKategoriami();

        // wyswietlanie produktow
        Produkty(mysqli_connect($dbhost, $dbuser, $dbpass, $baza));
        // zarzadzanie produktami
        echo ZarzadzajProduktami();

        //zarzadzanie stronami
        if(isset($_POST['btn-3'])){
            $page_title = $_POST['page_title'];
            $page_content = $_POST['page_content'];
            $checkbox = $_POST['page_active'];
            if ($checkbox)
                $is_active = 1;
            else
                $is_active = 0;

            $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('".$page_title."', '".$page_content."', '".$is_active."')";
            mysqli_query($conn, $query);
            header("Location: cms_page.php");
        }
        else if(isset($_POST['btn-2'])){
            $page_id = $_POST['page_id'];
            $query = "DELETE FROM page_list WHERE id = '".$page_id."'";
            mysqli_query($conn, $query);
            header("Location: cms_page.php");
        }
        else if(isset($_POST['btn-1'])){
            $page_id = $_POST['page_id'];
            $checkbox = $_POST['page_active'];
            if ($checkbox)
                $is_active = 1;
            else
                $is_active = 0;

            if(($_POST['page_title']!="") && $_POST['page_content']!=""){
                $page_title = $_POST['page_title'];
                $page_content = $_POST['page_content'];
                $query = "UPDATE page_list SET page_title='".$page_title."', page_content='".$page_content."', status='".$is_active."' WHERE id='".$page_id."'";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
            else if(($_POST['page_title']!="") && ($_POST['page_content']=='')){
                $page_title = $_POST['page_title'];
                echo $_POST['page_content'];
                $query = "UPDATE page_list SET page_title='".$page_title."', status='".$is_active."' WHERE id='".$page_id."'";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
            else if(($_POST['page_title']=="") && ($_POST['page_content']!="")){
                $page_content = $_POST['page_content'];
                $query = "UPDATE page_list SET page_content='".$page_content."', status='".$is_active."' WHERE id='".$page_id."'";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
        }
        // zarzadzanie kategoriami

        // edytowanie kategorii
        if(isset($_POST['edit-category'])){
            $id = $_POST['id'];

            if(($_POST['matka']!="") && $_POST['nazwa']!=""){
                $matka = $_POST['matka'];
                $nazwa = $_POST['nazwa'];
                $query = "UPDATE kategorie SET matka='".$matka."', nazwa='".$nazwa."' WHERE id='".$id."'";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
            else if(($_POST['matka']!="") && ($_POST['nazwa']=='')){
                $matka = $_POST['matka'];
                $query = "UPDATE kategorie SET matka='".$matka."' WHERE id='".$id."'";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
            else if(($_POST['matka']=="") && ($_POST['nazwa']!="")){
                $nazwa = $_POST['nazwa'];
                $query = "UPDATE kategorie SET nazwa='".$nazwa."' WHERE id='".$id."'";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
        }
        // usuniecie kategorii
        else if(isset($_POST['delete-category'])){
            $id = $_POST['id'];
            $query = "DELETE FROM kategorie WHERE id = '".$id."'";
            mysqli_query($conn, $query);
            header("Location: cms_page.php");
        }
        // dodanie kategorii
        else if(isset($_POST['add-category'])){
            $nazwa = $_POST['nazwa'];
            if($_POST['matka'!=""]){
                $matka = $_POST['matka'];
                $query = "INSERT INTO kategorie (nazwa, matka) VALUES ('".$nazwa."', '".$matka."')";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
            else{
                $query = "INSERT INTO kategorie (nazwa) VALUES ('".$nazwa."')";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
        }

        // zarzadzanie produktami

        // edytowanie produktow
        if(isset($_POST['edit-product'])){
            $id = $_POST['id'];
            $query = "UPDATE produkty SET ";
            if(isset($_POST['tytul']) && $_POST['tytul'] != ""){
                $query .= "tytul='".$_POST['tytul']."',";
            }
            if(isset($_POST['opis']) && $_POST['opis'] != ""){
                $query .= "opis='".$_POST['opis']."',";
            }
            if(!isset($_POST['data_modyfikacji'])){
                $query .= "data_modyfikacji='".date('Y-m-d H:i:s')."',";
            }
            if(isset($_POST['data_wygasniecia']) && $_POST['data_wygasniecia'] != ""){
                $query .= "data_wygasniecia='".$_POST['data_wygasniecia']."',";
            }
            if(isset($_POST['cena_netto']) && $_POST['cena_netto'] != ""){
                $query .= "cena_netto='".$_POST['cena_netto']."',";
            }
            if(isset($_POST['vat']) && $_POST['vat'] != ""){
                $query .= "podatek_vat='".$_POST['vat']."',";
            }
            if(isset($_POST['ilosc']) && $_POST['ilosc'] != ""){
                $query .= "ilosc='".$_POST['ilosc']."',";
            }
            if(isset($_POST['status']) || !isset($_POST['status'])){
                $is_active = $_POST['status'] ? 1 : 0;
                $query .= "status='".$is_active."',";
            }
            if(isset($_POST['kategoria']) && $_POST['kategoria'] != ""){
                $query .= "kategoria='".$_POST['kategoria']."',";
            }
            if(isset($_POST['gabaryt']) && $_POST['gabaryt'] != ""){
                $query .= "gabaryt_produktu='".$_POST['gabaryt']."',";
            }
            if(isset($_FILES['zdjecie']['name']) && !empty($_FILES['zdjecie']['tmp_name'])){
                $blob = addslashes(file_get_contents($_FILES['zdjecie']['tmp_name']));
                $query .= "zdjecie='".$blob."',";
            }
            if(substr($query,-1) == ',')
            $query = rtrim($query, ',');
            $query .= " WHERE id='".$id."'";
            mysqli_query($conn, $query);
            header("Location: cms_page.php");
        }
        // usuniecie produktu
        else if(isset($_POST['delete-product'])){
            $id = $_POST['id'];
            $query = "DELETE FROM produkty WHERE id = '".$id."'";
            mysqli_query($conn, $query);
            header("Location: cms_page.php");
        }
        // dodanie produktu
        else if(isset($_POST['add-product'])){
            if(($_POST['tytul']!="") && $_POST['opis']!="" && $_POST['data_wygasniecia']!="" && $_POST['cena_netto']!="" && $_POST['vat']!="" 
                && $_POST['ilosc']!="" && $_POST['kategoria']!="" && $_POST['gabaryt']!="" 
                && $_FILES['zdjecie']['name']!=""){

                $tytul = $_POST['tytul'];
                $opis = $_POST['opis'];
                $data_utworzenia = date('Y-m-d H:i:s');
                $data_modyfikacji = $data_utworzenia;
                $data_wygasniecia = $_POST['data_wygasniecia'];
                $cena_netto = $_POST['cena_netto'];
                $vat = $_POST['vat'];
                $ilosc = $_POST['ilosc'];
                $is_active = $_POST['status'] ? 1 : 0;
                $kategoria = $_POST['kategoria'];
                $gabaryt = $_POST['gabaryt'];
                $blob = addslashes(file_get_contents($_FILES['zdjecie']['tmp_name']));

                $query = "INSERT INTO produkty (tytul, opis, data_utworzenia, data_modyfikacji, data_wygasniecia, cena_netto, podatek_vat, ilosc, status, kategoria, gabaryt_produktu, zdjecie) 
                        VALUES ('".$tytul."', '".$opis."', '".$data_utworzenia."', '".$data_modyfikacji."', '".$data_wygasniecia."', '".$cena_netto."', '".$vat."', '".$ilosc."', '".$is_active."', '".$kategoria."', '".$gabaryt."', '".$blob."')";
                mysqli_query($conn, $query);
                header("Location: cms_page.php");
            }
        }
        ob_end_flush();
    ?>
</body>
</html>
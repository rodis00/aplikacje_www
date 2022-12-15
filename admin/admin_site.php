<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <title>Panel CMS</title>
</head>
<body>
    <?php
        session_start();
        require_once("../cfg.php");
        require_once("./admin.php");
        include("../php/contact.php");
        echo FormularzLogowania();
        PrzypomnijHaslo($pass);
        if(!isset($_POST['x2_submit'])){
            if(isset($_POST['login_email']) && isset($_POST['login_pass'])){
                $user = $_POST['login_email'];
                $password = $_POST['login_pass'];
                
                if(($user == $login) && ($password == $pass))
                {
                    $_SESSION['user'] = $user;
                    $_SESSION['zalogowany'] = true;
                    header("Location: cms_page.php");
                }
                else if($user != $login && $password == $pass)
                    echo '<div id="error">Niepoprawny login.</div>';
                else if($password != $pass && $user == $login)
                    echo '<div id="error">Niepoprawne hasło.</div>';
                else
                    echo '<div id="error">Niepoprawny login i hasło.</div>';
            }
            if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){  
                header('Location: cms_page.php');
                exit();
            }
        }
        else{
            // echo "wyslao";
        }
    ?>
</body>
</html>
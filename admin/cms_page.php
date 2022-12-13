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
        $user = $_SESSION['user'];
        echo '<p id="welcome-user">'.$user.'</p>';
        echo ListaPodstron(mysqli_connect($dbhost, $dbuser, $dbpass, $baza));
        echo '<a href="logout.php" id="logout_btn"> Wyloguj się</a>';
        echo EdytujPodstrone();

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
    ?>
</body>
</html>
<?php

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

    
?>


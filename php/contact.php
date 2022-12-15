<?php

function PokazKontakt(){
    echo '
        <div id="contact">
            <form method="POST" id="contactForm" action="https://formsubmit.co/1a8909e7d8c90b94b7cb2a340925e45b">
                <h1>Kontakt:</h1>
                <h3>Temat</h3>
                <input type="text" name="temat" placeholder="Temat maila" required/>
                <h3>Treść</h3>
                <textarea name="tresc" placeholder="Treść maila" rows="15" cols="55" required></textarea>
                <h3>Email</h3>
                <input type="email" name="email" placeholder="Wpisz swój email" required />
                <div>
                    <div><button type="submit" class="send">wyślij</button></div>
                </div>
                <input type="hidden" name="_next" value="http://localhost/php/stronka_v1.7/index.php?page=contact&id=8">
            </form>
        </div>
    ';
}


//----------------------------------------------//
//  wysylanie danych przez formularz kontaktowy //
//----------------------------------------------//
// przesyla dane z formularza kontaktowego

function WyslijMailKontak(){
    if(!isset($_POST['wyslij'])){
        echo PokazKontakt();
    }
    else{
        if(empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])){
        
            echo '<div class="error"><p>[nie_wypelniles_pola]</p></div>';
            echo PokazKontakt(); //ponowne wywolanie formularza
        }
        else{
            // $mail['subject'] = $_POST['temat'];
            // $mail['body'] = $_POST['tresc'];
            // $mail['sender'] = $_POST['email'];
            // $mail['reciptient'] = $odbiorca; // czyli my jestesmy odbiorca, jezeli tworzymy formularz kontaktowy
    
            // $header = "From: Formularz kontaktowy <".$mail['sender'].">\n";
            // $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\n\Content-Transfer-Encoding: ";
            // $header .= "X-Sender: <".$mail['sender'].">\n";
            // $header .= "X-Mailer: PRapwww mail 1.2\n";
            // $header .= "X-Priority: 3\n";
            // $header .= "Return-Path: <".$mail['sender'].">\n";
    
            // mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
    
            echo '<div class="correct"><p>[wiadomosc_wyslana]</p></div>';
        }
    }
}

function PrzypomnijHaslo($pass){
    echo'
        <form method="POST" id="contactForm" action="https://formsubmit.co/1a8909e7d8c90b94b7cb2a340925e45b">
            <input type="hidden" name="CMS-przypomnienie hasła" />
            <input type="hidden" name="haslo" value="'.$pass.'"/>
            <input type="hidden" name="_next" value="http://localhost/php/stronka_v1.7/admin/admin_site.php">
            <input type="submit" name="x2_submit" class="remember" value="Przypomnij haslo" />
        </form>
    ';
}

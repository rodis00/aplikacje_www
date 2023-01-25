<?php
    // skrypt zamykajacy sesje po ktorym uzytkownik zostaje przeniesiony
    // do sekcji logowania
    session_start();
    session_unset();
    header('Location: admin_site.php');


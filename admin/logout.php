<?php

    session_start();
    session_unset();
    header('Location: admin_site.php');


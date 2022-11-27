<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$baza = 'moja_strona';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);

if(!$conn){
    die('Connection failed: '.mysqli_connect_error());
}
echo "<script>console.log('connected successfully');</script>";

// if(!mysql_select_db($baza))
//     echo 'nie wybrano bazy';

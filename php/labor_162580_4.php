
<?php

$nr_indeksu = '162580';
$nrGrupy = '4';

echo 'Adrian Sidor '.$nr_indeksu.' grupa '.$nrGrupy.'<br>';
echo '<br>'.'zad_2 a)'.'<br>';
echo 'Zastosowanie metody include()'.'<br>';
echo 'Zastosowanie metody require_once()'.'<br>';

echo '<br>'.'zad_2 b)'.'<br>';

$a = 5;
$b = 10;
$c = 15;

// funkcja sprawdzajaca warunki if
if($a > $b)
    echo "$a".' > '."$b".'<br>';
else if($c > $a)
    echo "$c".' > '."$b".'<br>';
else
    echo "$b".' > '."$a".'<br>'; 

// switch wyswietla aktualny dzien
// pobiera dzien z metody date()
$day = date('l') ;
$text = 'Dziś jest: ';
switch($day){
    case "Monday":
        echo "$text".' poniedziałek';
        break;
    case "Tuesday":
        echo "$text".' wtorek';
        break;
    case "Wednesday":
        echo "$text".' środa';
        break;
    case "Thursday":
        echo "$text".' czwartek';
        break;
    case "Friday":
        echo "$text".' piątek';
        break;
    case "Saturday":
        echo "$text".' sobota';
        break;
    case "Sunday":
        echo "$text".' niedziela';
        break;
}echo '<br>';

echo '<br> zad_2 c)'.'<br>';
echo 'Pętla for <br>';
// test petli for
for($i=0; $i<5; $i++){
    echo 'i = '.($i + $i * 3 - $i / 2).'<br>';
}
echo 'pętla while <br>';
// test petli while
$a = 5;
while($a > 0){
    echo $a.'<br>';
    $a--;
}

echo '<br>zad_2 d) <br>';
// weryfikacja zmiennych pobieranych za 
// pomoca metody GET i POST
if(isset($_GET['number']))
    echo 'liczba z GET = '.$_GET['number'].'<br>';

if(isset($_POST['number2']))
    echo 'liczba z POST = '.$_POST['number2'].'<br>';

echo $_SESSION['active']? 'sesja aktywna' : 'sesja nieaktywna';


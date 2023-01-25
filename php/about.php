<?php 
session_start();
$_SESSION['active'] = true;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="Adrian Sidor">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="../img/orange_favicon.ico" type="image/x-icon">
    <script src="../js/kolorujtlo.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>about</title>
</head>
<body>
    <div id="container">
        <header>
            <nav>
                <ul class="nav-items">
                    <li><a href="../index.html">home</a></li>
                    <li><a href="../html/fun_fact.html">fun fact</a></li>
                    <li><a href="../html/species.html">species</a></li>
                    <li><a href="../html/events.html">events</a></li>
                    <li><a href="../html/store.html">store</a></li>
                    <li class="active"><a href="#">about</a></li>
                    <li><a href="mailto:162580@student.uwm.edu.pl?/Send mail">contact</a></li>
                </ul>
            </nav>
        </header>
        <section id="about" class="about-background">
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, illo quo repudiandae ea placeat officia asperiores dolorem deleniti fuga nihil?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, illo quo repudiandae ea placeat officia asperiores dolorem deleniti fuga nihil?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, illo quo repudiandae ea placeat officia asperiores dolorem deleniti fuga nihil?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, illo quo repudiandae ea placeat officia asperiores dolorem deleniti fuga nihil?</p>
            </div>
        </section>
        <section id="tasks">
            <div id="task-1">
                <form method="post" name="background">
                    <input type="button" value="niebieski" class="guzior" onclick="changeBackground('#0000FF')">
                </form>
            </div>
            <div id="task-2">
                <!-- skrypt powiekszajacy diva z kazdym kliknieciem na niego -->
                <div id="animacjaTestowa1" class="test-block">Kliknij, a się powiększe</div>
                <script>
                    $("#animacjaTestowa1").on("click", function(){
                        $(this).animate({
                            width: "500px",
                            opacity: 0.4,
                            fontSize: "3em",
                            borderWidth: "10px"
                        }, 1500);
                    });
                    // skrypt powiekszajacy diva po najechaniu kursorem
                </script>
                <div id="animacjaTestowa2" class="test-block">Najedź kursorem, a się powiększe</div>
                <script>
                    $("#animacjaTestowa2").on({
                        "mouseover" : function(){
                            $(this).animate({
                                width: 300
                            }, 800);
                        },
                        "mouseout" : function(){
                            $(this).animate({
                                width: 200
                            }, 800);
                        }
                    });
                    // skrypt powiekszajacy diva po klikaniu w niego
                </script>
                <div id="animacjaTestowa3" class="test-block">Klikaj, abym urósł</div>
                <script>
                    $("#animacjaTestowa3").on("click", function(){
                        if(!$(this).is(":animated")){
                            $(this).animate({
                                width: "+=" + 50,
                                height: "+=" + 10,
                                opacity: "-=" + 0.1,
                                duration: 3000 //inny sposób deklaracji czasu trwania animacji
                            });
                        }
                    });
                </script>
            </div>
            <div id="task-3">
                <div>
                    <?php include '../php/labor_162580_4.php';?>
                </div>
            </div>
            <div id="task-4">
                <div>
                    <?php require_once '../php/labor_162580_4.php';?>
                    <!-- test przeslania dancyh z formularza za pomoca metody GET -->
                    <form action="" method="GET">
                        <input type="text" name="number">Podaj liczbę i wciśnij enter:
                    </form>
                    <!-- test przeslania danych z formularza za pomoca metody POST -->
                    <form action="" method="POST">
                        <input type="text" name="number2">Podaj liczbę i wciśnij enter:
                    </form>
                </div>
            </div>
        </section>
        <footer>
            <div class="footer-text">
                <p>AS &copy 2022</p>
            </div>
            <div class="footer-items">
                <div><a href="../index.html">home</div>
                <div><a href="../html/fun_fact.html">fun fuct</div>
                <div><a href="../html/species.html">species</div>
                <div><a href="../html/events.html">events</div>
                <div><a href="../html/store.html">store</div>
                <div><a href="../html/about.php">about</div>
                <div><a href="../html/contact.html">contact</div>
            </div>
        </footer>
    </div>
</body>
</html>
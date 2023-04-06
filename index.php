<?php
    session_start();
    require_once "Config/databaseConnexion.php";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/flex.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    <title>Quizz</title>
</head>
<body>
    <div class="background">
        <header>
            <ul class="flex space-evenly ">
                <li class="menu"><a href="/">Home</a></li>
                <?php if(isset($_SESSION['user'])) : ?>
                        <li  class="menu"><a href="profil">Page profil</a></li>

                <?php endif ?>
                <li  class="menu">
                    <?php if(isset($_SESSION['user'])) : ?>
                        <a href="deconnexion">Deconnexion</a>
                    <?php else :?>
                        <a href="connexion">Connexion</a>
                    <?php endif ?>
                </li>
                <li class="menu"><a href="inscription">inscription</a></li>
            </ul>
        </header>
        <main>
            
            <?php 
            require_once "Controllers/usersController.php";
            require_once "Controllers/quizzController.php";
            ?>
        </main>
        <footer>
            
        </footer>
    </div>
    
</body>
</html>

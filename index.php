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
    <title>Mon agence</title>
</head>
<body>
    <header>
        <ul class="flex space-evenly ">
            <li class="menu"><a href="/">Home</a></li>
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
        require_once "Controllers/usersController.php"
        ?>
    </main>
    <footer>
        
    </footer>
</body>
</html>

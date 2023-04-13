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
    <title>IKUIZZ</title>
</head>
<body>
    <div class="background">
        <header>
        
            <div class="menu">   
                <ul>
                    <li><a href="/">Acceuil</a></li>
                </ul>
            </div>
            <!--<div>
                <ul>
                    <img src="Images/iquizzSansFond.png" alt="">
                </ul>
            </div>-->
            <div class="right-menu flex ">
                <ul>
                    
                    <li class="menu Deroulant">
                        <a class="profilMenu">Profil</a>
                        <div class="autreMenu">
                            <?php if(isset($_SESSION['user'])) : ?>
                                <a href="profil">Voir profil</a>
                                <a href="deconnexion">Deconnexion</a>
                                <a href="#">Mes quizzs</a>
                            <?php else :?>
                                <a href="connexion">Connexion</a>
                                <a href="inscription">Inscription</a>
                            <?php endif ?>

                    </div>
                    </li>
                    <li><a href="creerQuizz">Créer un quizz</a></li>
                </ul>
            </div>
            


                    
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

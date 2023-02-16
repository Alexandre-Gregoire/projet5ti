<?php
    
    require_once "Config/databaseConnexion.php";
    /*try {
        $query = "SELECT * FROM `biens`";
        $ajoute = $pdo->prepare($query);
        $ajoute->execute();
        $biens = $ajoute->fetchAll();
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
    echo '<pre>' , var_dump($biens) , '</pre>';
    */
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
            <li class="menu"><a href="connexion">connexion</a></li>
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

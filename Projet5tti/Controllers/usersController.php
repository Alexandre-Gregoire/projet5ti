<?php
require_once("Models/userModel.php");
$uri = $_SERVER['REQUEST_URI'];

if($uri === "/" || $uri === "index.php"){
    require_once "Templates/Questions/acceuil.php";
}elseif($uri === "/connexion"){
    require_once "Templates/Users/connexion.php";
}elseif ($uri === "/inscription") {
    if(isset($_POST['btnEnvoi']) && !empty($_POST['pseudo'])&& !empty($_POST['mail'])&& !empty($_POST['password']))
    {
        createUser($pdo);

        header('Location: connexion');
    }
    else{
        require_once "Templates/Users/inscription.php";
    }
    

}
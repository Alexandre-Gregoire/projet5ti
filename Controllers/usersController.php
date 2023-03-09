<?php
require_once("Models/userModel.php");
$uri = $_SERVER['REQUEST_URI'];

if($uri === "/" || $uri === "index.php"){
    require_once "Templates/Questions/acceuil.php";
}elseif ($uri === "/inscription") {
    if(isset($_POST['btnEnvoi']) && !empty($_POST['pseudo'])&& !empty($_POST['mail'])&& !empty($_POST['password']))
    {
        createUser($pdo);

        header('Location: connexion');
    }
    else{
        require_once "Templates/Users/inscription.php";
    }
}elseif ($uri === "/connexion") {
    //var_dump($_SESSION);
    if(isset($_POST["btnEnvoi"])){
        var_dump("bouton apuyer");
        //var_dump($_POST);
        connectUser($pdo);
        header('location:/');
    }
    require_once "Templates/users/connexion.php";
}elseif ($uri === "/profil") {
    require_once "Templates/users/profil.php";
}elseif ($uri === "/deconnexion") {
    session_destroy();
    header('location:/');
}
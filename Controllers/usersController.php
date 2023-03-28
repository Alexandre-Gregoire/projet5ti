<?php
require_once("Models/userModel.php");
$uri = $_SERVER['REQUEST_URI'];

if($uri === "/" || $uri === "index.php"){
    require_once "Templates/Questions/acceuil.php";
}elseif ($uri === "/inscription") {
    if(isset($_POST['btnEnvoi']))
    {
        $messageErrorLogin = verifData();
        if(!$messageErrorLogin){
            createUser($pdo);
            //header('Location: connexion');
        }
        
    }
    
    require_once "Templates/Users/inscription.php";
    
}elseif ($uri === "/connexion") {
    //var_dump($_SESSION);
    if(isset($_POST["btnEnvoi"])){
        var_dump("toto");
        connectUser($pdo);
        header('location:/');
    }
    require_once "Templates/users/connexion.php";
}elseif ($uri === "/profil") {
    require_once "Templates/users/profil.php";
}elseif ($uri === "/deconnexion") {
    session_destroy();
    header('location:/');
}elseif ($uri === "/modifyProfil") {
    if(isset($_POST["btnEnvoi"])){
        var_dump("cliqued");
        updateUser($pdo);
        //reloadSession($pdo);
        header("location:/profil");
    }
    require_once "Templates/users/inscription.php";
}







function verifData() {
    foreach($_POST as $key => $value){
        if(empty(str_replace(" ","", $value))){
            $messageErrorLogin[$key] = "Votre " . $key . " est vide";
        }/*elseif($key == "mail" && filter_var($value, FILTER_VALIDATE_EMAIL)){
            $messageErrorLogin[$key] = "Votre adresse mail est invalide";
        }*/
    }
    if (isset($messageError)) {
        return $messageError;
    }
    else {
        return false;        
    }

}
<?php
require_once("Models/userModel.php");
$uri = $_SERVER['REQUEST_URI'];

if ($uri === "/inscription") {
    if(isset($_POST['btnEnvoi']))
    {
        $messageErrorLogin = verifData();
        if(!$messageErrorLogin){
            createUser($pdo);
            header('Location: connexion');
        }
        
    }
    
    require_once "Templates/Users/inscription.php";
    
}elseif ($uri === "/connexion") {
    
    if(isset($_POST["btnEnvoi"])){
        $messageErrorLogin = connectUser($pdo);
        if(!$messageErrorLogin){
            connectUser($pdo);
            header('location:/');
        }
    }
    require_once "Templates/users/connexion.php";
}elseif ($uri === "/profil") {
    require_once "Templates/users/profil.php";
}elseif ($uri === "/deconnexion") {
    session_destroy();
    header('location:/');
}elseif ($uri === "/modifyProfil") {
    if(isset($_POST["btnEnvoi"])){
        
        updateUser($pdo);
        reloadSession($pdo);
        header("location:/profil");
    }
    require_once "Templates/users/inscription.php";
}elseif ($uri === "/deleteProfil") {

    deleteUser($pdo);
    session_destroy();
    header('location:/inscription');
}







function verifData() {
    
    foreach($_POST as $key => $value){
        if(empty(str_replace(" ","", $value))){
            
            $messageErrorLogin[$key] = "Votre " . $key . " est vide";
        }/*elseif($key == "mail" && filter_var($value, FILTER_VALIDATE_EMAIL)){
            $messageErrorLogin[$key] = "Votre adresse mail est invalide";
        }*/
    }
    if (isset($messageErrorLogin)) {
        return $messageErrorLogin;
    }
    else {
        return false;        
    }
}

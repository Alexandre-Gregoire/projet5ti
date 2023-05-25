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
}elseif ($uri === "/discuter") {
    $groupes = selectAllConversationGroupe($pdo);
    $users = selectAllUserExceptConnected($pdo);
    if (isset($_POST["btnEnvoi"])) {
        $conversationId = createConversationGroupe($pdo);
        header('location:/chat?conversationId='.$conversationId);
    }
    require_once "Templates/users/toutLeschat.php";
}elseif (str_contains($uri , "/chat?utilisateurId=") ){
    $_SESSION['uri'] = $uri;
    $users = testConversation($pdo);
    $conversationId = $users->conversationId;
    $messages = recupAllMessage($pdo,$conversationId);
    if (empty($users)) {
        createConversation($pdo);
    }
    if(isset($_POST["btnEnvoi"])){
        
        $messageErrorLogin = verifData();
        if(!$messageErrorLogin){
            envoieMessage($pdo,$conversationId);
            
            header('location:'.$uri);
        }

    }
    require_once "Templates/users/chat.php";
    
}elseif (str_contains($uri , "/chat?conversationId=") ){
    $_SESSION['uri'] = $uri;
    $conversationId = $_GET['conversationId'];
    $messages = recupAllMessage($pdo,$conversationId);
    
    if(isset($_POST["btnEnvoi"])){
        
        $messageErrorLogin = verifData();
        if(!$messageErrorLogin){
            envoieMessage($pdo,$conversationId);
            header('location:'.$uri);
        }

    }
    require_once "Templates/users/chat.php";
    
    
}elseif (str_contains($uri , "modify?messageId=") ){
    updateMessage($pdo);
    header('location:'.$_SESSION['uri']);
}elseif (str_contains($uri , "delete?messageId=") ){
    deleteMessage($pdo);
    header('location:'.$_SESSION['uri']);
}








function verifData() {
    
    foreach($_POST as $key => $value){
        if(empty(str_replace(" ","", $value))){
            
            $messageErrorLogin[$key] = "Votre " . $key . " est vide";
        }
    }
    if (isset($messageErrorLogin)) {
        return $messageErrorLogin;
    }
    else {
        return false;        
    }
}

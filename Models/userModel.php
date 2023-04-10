<?php
function createUser($pdo)
{
    try{
        $query = "insert into utilisateur (utilisateurPseudo, utilisateurMdp, utilisateurEmail, utilisateurRole) values (:nomUser, :mdpUser, :mailUser, :roleUser)"; //nom des colonnes utilisateur
        $newUser = $pdo->prepare($query);
        $newUser->execute([
            'nomUser' => $_POST["pseudo"],
            'mailUser' => $_POST["mail"],
            'mdpUser' => $_POST["password"],
            'roleUser' => 'membre' 
            
        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function connectUser($pdo){
    try {
        $query = "select * from utilisateur where utilisateurPseudo = :loginUser and utilisateurMdp = :passwordUser";
        $connectUser = $pdo->prepare($query);
        $connectUser->execute([
            'loginUser' => $_POST['pseudo'],
            'passwordUser' => $_POST['password'],
        ]);
        $user = $connectUser->fetch();
        //var_dump($user);
        if($user)
        {
            $_SESSION['user'] = $user;
        }
        else{
            $messageErrorLogin = "Votre pseudo ou mot de passe est invalide";
            return $messageErrorLogin;
        }
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function updateUser($pdo)
{
    try {
        $query = "UPDATE utilisateur SET utilisateurPseudo = :utilisateurPseudo, utilisateurMdp = :utilisateurMdp, utilisateurEmail = :utilisateurEmail WHERE utilisateurId = :id";
        $updateUser = $pdo->prepare($query);
        $updateUser->execute([
            'utilisateurPseudo' => $_POST['pseudo'],
            'utilisateurMdp' => $_POST['password'],
            'utilisateurEmail' => $_POST['mail'],
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        reloadSession($pdo);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

function reloadSession($pdo)
{
    try {
        $query = "select * from utilisateur where utilisateurId = :id";
        $chercheUser = $pdo->prepare($query);
        $chercheUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        $user=$chercheUser -> fetch();
        if ($user) {
            $_SESSION['user']=$user;
        }
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}



function deleteUser($pdo)
{
    try {
        $query = "update score set utilisateurId=null where utilisateurId = :id";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        $query = "update quizz_utilisateur set utilisateurId=null where utilisateurId = :id";
        $updateQuizzUser = $pdo->prepare($query);
        $updateQuizzUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
        $query = "delete from utilisateur where utilisateurId = :id";
        $deleteUser = $pdo->prepare($query);
        $deleteUser->execute([
            'id' => $_SESSION["user"]->utilisateurId
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
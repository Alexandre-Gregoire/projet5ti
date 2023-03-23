<?php
function createUser($pdo)
{
    try{
        $query = "insert into utilisateur (utilisateurPseudo, utilisateurMdp, utilisateurEmail) values (:nomUser, :mdpUser, :mailUser)"; //nom des colonnes utilisateur
        $newUser = $pdo->prepare($query);
        $newUser->execute([
            'nomUser' => $_POST["pseudo"],
            'mdpUser' => $_POST["mail"],
            'mailUser' => $_POST["password"],
            
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
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

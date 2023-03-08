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

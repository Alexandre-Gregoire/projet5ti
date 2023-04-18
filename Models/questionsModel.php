<?php
function createBonneReponse($pdo)
{
    try{
        $query = "INSERT INTO Bonne_Reponse (bonneReponseText)  VALUES (bonneReponseText);"; //nom des colonnes utilisateur
        $newBonneReponse = $pdo->prepare($query);
        $newBonneReponse->execute([
            'bonneReponseText' => $_POST['xxxxxx'],

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function createQuestion($pdo)
{
    try{
        $query = "INSERT INTO question (questionText,bonneReponseId)  VALUES (:questionText,:bonneReponseId);"; //nom des colonnes utilisateur
        $newQuestion = $pdo->prepare($query);
        $newQuestion->execute([
            'questionText' => $_POST['NomQuizz'],
            'bonneReponseId' => $pdo->lastInsertId()

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function createMauvaiseReponse($pdo)
{
    try{
        $query = "INSERT INTO quizz (quizzNom, quizzDifficulte, quizzDateCreation, utilisateurId, categorieId)  VALUES (:quizzNom, :quizzDifficulte, NOW(), :utilisateurId, :categorieId);"; //nom des colonnes utilisateur
        $newMauvaiseReponse = $pdo->prepare($query);
        $newMauvaiseReponse->execute([
            'quizzNom' => $_POST['NomQuizz'],
            'quizzDifficulte' => $_POST['difficulte'],

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
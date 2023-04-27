<?php
function createBonneReponse($pdo)
{
    try{
        $query = "INSERT INTO Bonne_Reponse (bonneReponseText)  VALUES (bonneReponseText);"; 
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
        $query = "INSERT INTO question (questionText,bonneReponseId)  VALUES (:questionText,:bonneReponseId);"; 
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
        $query = "INSERT INTO quizz (quizzNom, quizzDifficulte, quizzDateCreation, utilisateurId, categorieId)  VALUES (:quizzNom, :quizzDifficulte, NOW(), :utilisateurId, :categorieId);"; 
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

function selectQuizzInfo($pdo)
{
    try{
        $query = "SELECT * FROM quizz INNER JOIN categorie ON quizz.categorieId = categorie.categorieId WHERE quizz.quizzId = :quizzId;"; 
        $quizzSelectInfo = $pdo->prepare($query);
        $quizzSelectInfo->execute([
            'quizzId' => $_SESSION["quizzId"]
        ]);
        $quizzInfos = $quizzSelectInfo->fetch();
        return $quizzInfos;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
<?php
function createBonneReponse($pdo)
{
    try{
        $query = "INSERT INTO Bonne_Reponse (bonneReponseText)  VALUES (bonneReponseText);"; 
        $newBonneReponse = $pdo->prepare($query);
        $newBonneReponse->execute([
            'bonneReponseText' => $_POST['BonneReponse'],

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
            'questionText' => $_POST['question'],
            'bonneReponseId' => $pdo->lastInsertId()

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function createMauvaiseReponse($pdo,$counterMauvaiseReponse)
{
    try{
        $query = "insert into mauvaise_reponse (mauvaiseReponseText,questionId) values (:mauvaiseReponseText,:questionId);"; 
        $newMauvaiseReponse = $pdo->prepare($query);
        $newMauvaiseReponse->execute([
            'mauvaiseReponseText' => $_POST['MauvaiseReponse'.$counterMauvaiseReponse],
            'questionId' => $pdo->lastInsertId(),

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function selectQuestionCreation($pdo)
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
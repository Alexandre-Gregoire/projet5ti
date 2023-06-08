<?php
function createBonneReponse($pdo)
{
    try{
        $query = "INSERT INTO Bonne_Reponse (bonneReponseText)  VALUES (:bonneReponseText);"; 
        $newBonneReponse = $pdo->prepare($query);
        $newBonneReponse->execute([
            'bonneReponseText' => htmlentities($_POST['BonneReponse']),

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
        $query = "INSERT INTO question (questionText,bonneReponseId,quizzId)  VALUES (:questionText,:bonneReponseId,:quizzId);"; 
        $newQuestion = $pdo->prepare($query);
        $newQuestion->execute([
            'questionText' => htmlentities($_POST['question']),
            'bonneReponseId' => $pdo->lastInsertId(),
            'quizzId' => $_SESSION["quizzId"]

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function createMauvaiseReponse($pdo,$counterMauvaiseReponse,$questionId)
{   
    $NomMauvaiseReponse = "MauvaiseReponse".$counterMauvaiseReponse;
    try{
        $query = "insert into mauvaise_reponse (mauvaiseReponseText,questionId) values (:mauvaiseReponseText,:questionId);"; 
        $newMauvaiseReponse = $pdo->prepare($query);
        $newMauvaiseReponse->execute([
            'mauvaiseReponseText' => htmlentities($_POST[$NomMauvaiseReponse]),
            'questionId' => $questionId,

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

function modifierMauvaiseReponse($pdo,$counterMauvaiseReponse)
{
    $NomMauvaiseReponse = "MauvaiseReponse".$counterMauvaiseReponse;
    $NomMauvaiseReponseId = "IdMauvaiseReponse".$counterMauvaiseReponse;
    try{
        $query = "update mauvaise_reponse set mauvaiseReponseText = :mauvaiseReponseText where mauvaiseReponseId = :mauvaiseReponseId"; 
        $quizzSelectInfo = $pdo->prepare($query);
        $quizzSelectInfo->execute([
            'mauvaiseReponseText' => htmlentities($_POST[$NomMauvaiseReponse]),
            'mauvaiseReponseId' => htmlentities($_POST[$NomMauvaiseReponseId])
        ]);
        $quizzInfos = $quizzSelectInfo->fetch();
        return $quizzInfos;
        
    }
    
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }

}



function ModifierQuizz($pdo)
{
    try{
        $query = "update quizz set quizzNom = :quizzNom,quizzDifficulte = :quizzDifficulte,categorieId = :categorieId  where quizzId = :quizzId"; //nom des colonnes utilisateur
        $newUser = $pdo->prepare($query);
        $newUser->execute([
            'quizzNom' => htmlentities($_POST['NomQuizz']),
            'quizzDifficulte' => htmlentities($_POST['difficulte']),
            'categorieId' => htmlentities($_POST['categorieQuizz']),
            'quizzId' => $_GET["quizzId"]

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function modifierBonneReponse($pdo)
{
    try{
        $query = "UPDATE bonne_reponse SET bonneReponseText = :bonneReponseText WHERE bonneReponseId IN (SELECT bonneReponseId FROM question WHERE questionId = :questionId)"; 
        $quizzSelectInfo = $pdo->prepare($query);
        $quizzSelectInfo->execute([
            'bonneReponseText' => htmlentities($_POST["BonneReponse"]),
            'questionId' => $_GET["questionId"],
        ]);
        $quizzInfos = $quizzSelectInfo->fetch();
        return $quizzInfos;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function modifierQuestion($pdo)
{
    try{
        $query = "update question set questionText = :questionText where questionId = :questionId"; 
        $quizzSelectInfo = $pdo->prepare($query);
        $quizzSelectInfo->execute([
            'questionText' => htmlentities($_POST["question"]),
            'questionId' => $_GET["questionId"],
        ]);
        $quizzInfos = $quizzSelectInfo->fetch();
        return $quizzInfos;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}




function deleteQuestion($pdo)
{
    try {
        $query = "DELETE FROM mauvaise_reponse WHERE questionId = :questionId";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'questionId' => $_GET["questionId"]
        ]);
        $query = "DELETE FROM question WHERE questionId = :questionId;";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'questionId' => $_GET["questionId"]
        ]);
        $query = "DELETE FROM bonne_reponse WHERE bonneReponseId IN (SELECT question.bonneReponseId FROM question WHERE question.questionId = :questionId);";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'questionId' => $_GET["questionId"]
        ]);
        
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
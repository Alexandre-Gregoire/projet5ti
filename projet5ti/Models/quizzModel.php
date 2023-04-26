<?php
function selectAllQuizzWithCategorie($pdo)
{
    try {
        $query = "SELECT quizz.quizzId, quizz.quizzNom, categorie.categorieNom, categorie.categorieImage, quizz.quizzDifficulte, MAX(score.score) AS score FROM quizz JOIN categorie ON quizz.categorieId = categorie.categorieId JOIN score ON quizz.quizzId = score.quizzId GROUP BY quizz.quizzId";
        $selectAllQuizz = $pdo->prepare($query);
        $selectAllQuizz->execute();
        $quizzs = $selectAllQuizz->fetchAll();
        var_dump($quizzs);
        return $quizzs;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

}

function selectAllCategorie($pdo)
{
    try {
        $query = "SELECT * FROM categorie;";
        $selectAllCategorie = $pdo->prepare($query);
        $selectAllCategorie->execute();
        $categories = $selectAllCategorie->fetchAll();
        //var_dump($quizzs);
        return $categories;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

}

function createQuizz($pdo)
{
    try{
        $query = "INSERT INTO quizz (quizzNom, quizzDifficulte, quizzDateCreation, utilisateurId, categorieId)  VALUES (:quizzNom, :quizzDifficulte, NOW(), :utilisateurId, :categorieId);"; //nom des colonnes utilisateur
        $newUser = $pdo->prepare($query);
        $newUser->execute([
            'quizzNom' => $_POST['NomQuizz'],
            'quizzDifficulte' => $_POST['difficulte'],
            'utilisateurId' => $_SESSION["user"]->utilisateurId,
            'categorieId' => $_POST['categorieQuizz']

        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function createScore($pdo)
{
    try{
        $query = "INSERT INTO score (score,date,quizzId,utilisateurId)  VALUES (null,now(),:quizzId,null);"; //nom des colonnes utilisateur
        $newUser = $pdo->prepare($query);
        $newUser->execute([
            'quizzId' => $_SESSION["quizzId"]
        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}






function selectQuizzQuestion($pdo)
{
    try{
        $query = "SELECT bonne_reponse.*, question.* FROM bonne_reponse INNER JOIN question ON bonne_reponse.bonneReponseId = question.bonneReponseId INNER JOIN quizz ON question.quizzId = quizz.quizzId WHERE quizz.quizzId = :quizzId;"; //nom des colonnes utilisateur
        $selectQuizz = $pdo->prepare($query);
        $selectQuizz->execute([
            'quizzId' => $_GET["quizzId"],
        ]);
        $quizz = $selectQuizz->fetchAll();
        var_dump($quizz);
        return $quizz;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}



function selectQuizzMauvaiseReponse($pdo,$questionId)
{
    try{
        $query = "SELECT * FROM mauvaise_reponse WHERE questionId IN (SELECT questionId FROM question WHERE questionId = :questionId);";
        $selectQuizz = $pdo->prepare($query);
        $selectQuizz->execute([
            'questionId' => $questionId
            
        ]);
        $quizzMauvaiseReponse = $selectQuizz->fetchAll();
        return $quizzMauvaiseReponse;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

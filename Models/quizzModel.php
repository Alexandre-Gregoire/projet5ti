<?php
function selectAllQuizzWithCategorie($pdo)
{
    try {
        $query = "SELECT quizz.quizzId, quizz.quizzNom, categorie.categorieNom, categorie.categorieImage, quizz.quizzDifficulte, MAX(score.score) AS score, utilisateur.utilisateurPseudo FROM quizz JOIN categorie ON quizz.categorieId = categorie.categorieId JOIN score ON quizz.quizzId = score.quizzId JOIN utilisateur ON quizz.utilisateurId = utilisateur.utilisateurId GROUP BY quizz.quizzId";
        $selectAllQuizz = $pdo->prepare($query);
        $selectAllQuizz->execute();
        $quizzs = $selectAllQuizz->fetchAll();

        return $quizzs;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

}
function selectAllQuizzUtilisateur($pdo)
{
    try {
        $query = "SELECT quizz.quizzId, quizz.quizzNom, categorie.categorieNom, categorie.categorieImage, quizz.quizzDifficulte, MAX(score.score) AS score, utilisateur.utilisateurPseudo FROM quizz JOIN categorie ON quizz.categorieId = categorie.categorieId JOIN score ON quizz.quizzId = score.quizzId JOIN utilisateur ON quizz.utilisateurId = utilisateur.utilisateurId where quizz.utilisateurId = :utilisateurId GROUP BY quizz.quizzId ";
        $selectAllQuizz = $pdo->prepare($query);
        $selectAllQuizz->execute([
            'utilisateurId'=> $_SESSION['user'] -> utilisateurId
        ]);
        $quizzs = $selectAllQuizz->fetchAll();

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
            'quizzNom' => htmlentities($_POST['NomQuizz']),
            'quizzDifficulte' => htmlentities($_POST['difficulte']),
            'utilisateurId' => $_SESSION["user"]->utilisateurId,
            'categorieId' => htmlentities($_POST['categorieQuizz'])

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
        $query = "INSERT INTO score (score,date,quizzId,utilisateurId)  VALUES ('0',now(),:quizzId,null);"; //nom des colonnes utilisateur
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
        return $quizz;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function selectQuizzQuestionPourCreation($pdo)
{
    try{
        $query = "SELECT bonne_reponse.*, question.* FROM bonne_reponse INNER JOIN question ON bonne_reponse.bonneReponseId = question.bonneReponseId INNER JOIN quizz ON question.quizzId = quizz.quizzId WHERE quizz.quizzId = :quizzId ORDER BY question.questionId DESC;"; //nom des colonnes utilisateur
        $selectQuizz = $pdo->prepare($query);
        $selectQuizz->execute([
            'quizzId' => $_SESSION['quizzId'],
        ]);
        $quizz = $selectQuizz->fetchAll();
        return $quizz;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

function TestSiBonneReponse($pdo,$questionId)
{
    try{
        $query = "SELECT bonneReponseText FROM bonne_reponse INNER JOIN question ON bonne_reponse.bonneReponseId = question.bonneReponseId WHERE question.questionId = :questionId";
        $selectQuizzBonneReponse = $pdo->prepare($query);
        $selectQuizzBonneReponse->execute([
            'questionId' => $questionId
            
        ]);
        $quizzBonneReponse = $selectQuizzBonneReponse->fetch();
        return $quizzBonneReponse;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function addScore($pdo,$score)
{
    try{
        $query = "insert into score(score,date,quizzId,utilisateurId) values (:score,now(),:quizzId,:utilisateurId)";
        $selectScore = $pdo->prepare($query);
        $selectScore->execute([
            'score' => $score,
            'quizzId' => $_GET["quizzId"],
            'utilisateurId' => $_SESSION["user"]-> utilisateurId
            
        ]);
        $score = $selectScore->fetchAll();
        return $score;
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}
function topScore($pdo)
{
    try{
        $query = "SELECT score.score, utilisateur.utilisateurPseudo FROM score JOIN utilisateur ON score.utilisateurId = utilisateur.utilisateurId WHERE score.quizzId = :quizzId ORDER BY score.score DESC LIMIT 10;";
        $selectQuizz = $pdo->prepare($query);
        $selectQuizz->execute([
            'quizzId' => $_GET["quizzId"]
            
        ]);
        $toutLesScore = $selectQuizz->fetchAll();
        return $toutLesScore;
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




function deleteQuizz($pdo)
{
    try {
        $query = "DELETE FROM score WHERE quizzId = :quizzId;";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'quizzId' => $_GET["quizzId"]
        ]);
        $query = "DELETE FROM mauvaise_reponse WHERE questionId IN (SELECT questionId FROM question WHERE quizzId = :quizzId);";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'quizzId' => $_GET["quizzId"]
        ]);
        $query = "DELETE FROM question WHERE quizzId = :quizzId;";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'quizzId' => $_GET["quizzId"]
        ]);
        $query = "DELETE FROM bonne_reponse WHERE bonneReponseId IN (SELECT question.bonneReponseId FROM question WHERE question.quizzId = :quizzId);";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'quizzId' => $_GET["quizzId"]
        ]);
        $query = "DELETE FROM quizz WHERE quizzId = :quizzId;";
        $updateScoreUser = $pdo->prepare($query);
        $updateScoreUser->execute([
            'quizzId' => $_GET["quizzId"]
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
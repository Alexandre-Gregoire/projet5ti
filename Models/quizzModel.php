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

function selectQuizz($pdo)
{
    try{
        $query = "SELECT question.questionText as question, bonne_reponse.bonneReponseText as bonneReponse, mauvaise_reponse.mauvaiseReponseText as mauvaiseReponse, quizz.quizzNom, utilisateur.utilisateurPseudo as createur, quizz.quizzDateCreation FROM quizz_question INNER JOIN question ON quizz_question.questionId = question.questionId LEFT JOIN bonne_reponse ON question.bonneReponseId = bonne_reponse.bonneReponseId LEFT JOIN mauvaise_reponse ON question.questionId = mauvaise_reponse.questionId INNER JOIN quizz ON quizz_question.quizzId = quizz.quizzId INNER JOIN quizz_utilisateur ON quizz.quizzId = quizz_utilisateur.quizzId INNER JOIN utilisateur ON quizz_utilisateur.utilisateurId = utilisateur.utilisateurId WHERE quizz_question.quizzId = :quizzId ORDER BY quizz_question.quizzQuestionId;"; //nom des colonnes utilisateur
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

function selectQuizzQuestions($pdo)
{
    try{
        $query = "SELECT question.questionText as question, bonne_reponse.bonneReponseText as bonneReponse, mauvaise_reponse.mauvaiseReponseText as mauvaiseReponse, quizz.quizzNom, utilisateur.utilisateurPseudo as createur, quizz.quizzDateCreation FROM quizz_question INNER JOIN question ON quizz_question.questionId = question.questionId LEFT JOIN bonne_reponse ON question.bonneReponseId = bonne_reponse.bonneReponseId LEFT JOIN mauvaise_reponse ON question.questionId = mauvaise_reponse.questionId INNER JOIN quizz ON quizz_question.quizzId = quizz.quizzId INNER JOIN quizz_utilisateur ON quizz.quizzId = quizz_utilisateur.quizzId INNER JOIN utilisateur ON quizz_utilisateur.utilisateurId = utilisateur.utilisateurId WHERE quizz_question.quizzId = :quizzId ORDER BY quizz_question.quizzQuestionId;"; //nom des colonnes utilisateur
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


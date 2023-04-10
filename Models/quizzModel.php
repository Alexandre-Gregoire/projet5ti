<?php
function selectAllQuizzWithCategorie($pdo)
{
    try {
        $query = "SELECT quizz.quizzNom, categorie.categorieNom, categorie.categorieImage, quizz.quizzDifficulte, MAX(score.score) AS score FROM quizz JOIN categorie ON quizz.categorieId = categorie.categorieId JOIN score ON quizz.quizzId = score.quizzId GROUP BY quizz.quizzId";
        $selectAllQuizz = $pdo->prepare($query);
        $selectAllQuizz->execute();
        $quizzs = $selectAllQuizz->fetchAll();
        //var_dump($quizzs);
        return $quizzs;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

}

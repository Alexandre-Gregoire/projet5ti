<?php
function selectAllQuizzWithCategorie($pdo)
{
    try {
        $query = "select * from quizz join categorie on quizz.categorieId = categorie.categorieId";
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

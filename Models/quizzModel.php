<?php
function selectAllQuizz($pdo)
{
    try {
        $query = "SELECT * FROM quizz";
        $selectAllQuizz = $pdo->prepare($query);
        $selectAllQuizz->execute();
        $quizzs = $selectAllQuizz->fetchAll();
        //var_dump($quizzs);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
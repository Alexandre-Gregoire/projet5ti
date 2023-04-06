<?php
function selectAllCategorie($pdo)
{
    try {
        $query = "select * from quizz join categorie on quizz.categorieId = categorie.categorieId";
        $selectAllCategorie = $pdo->prepare($query);
        $selectAllCategorie->execute();
        $categories = $selectAllCategorie->fetchAll();
        var_dump($categories);
        return $categories;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

}
<?php
function createCategorie($pdo){
    try {
        $query = "insert into categorie (categorieNom,categorieImage) values (:categorieNom,:categorieImage)";
        $selectAllCategorie = $pdo->prepare($query);
        $selectAllCategorie->execute([
            'categorieNom' => $_POST['categorieNom'],
            'categorieImage' => $_POST['categorieImage'],

        ]);
        $categories = $selectAllCategorie->fetchAll();
        return $categories;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function recupToutesCategorie($pdo){
    try {
        $query = "SELECT * FROM categorie";
        $selectAllCategorie = $pdo->prepare($query);
        $selectAllCategorie->execute([]);
        $listeCategories = $selectAllCategorie->fetchAll();
        return $listeCategories;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

}
function deleteCategorie($pdo,$categorieId){
    try {
        $query = "UPDATE quizz SET categorieId = NULL WHERE categorieId = :categorieId";
        $updateQuizzUser = $pdo->prepare($query);
        $updateQuizzUser->execute([
            'categorieId' => $categorieId
        ]);
        $query = "delete from categorie where categorieId = :categorieId";
        $selectAllCategorie = $pdo->prepare($query);
        $selectAllCategorie->execute([
            'categorieId' => $categorieId
        ]);
        $listeCategories = $selectAllCategorie->fetchAll();
        return $listeCategories;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }

}

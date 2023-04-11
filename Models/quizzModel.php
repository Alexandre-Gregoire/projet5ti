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

function selectAllCategorie($pdo)
{
    try {
        $query = "SELECT DISTINCT categorieNom, categorieImage FROM categorie;";
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
        $query = "insert into utilisateur (utilisateurPseudo, utilisateurMdp, utilisateurEmail, utilisateurRole) values (:nomUser, :mdpUser, :mailUser, :roleUser)"; //nom des colonnes utilisateur
        $newUser = $pdo->prepare($query);
        $newUser->execute([
            'nomUser' => $_POST["pseudo"],
            'mailUser' => $_POST["mail"],
            'mdpUser' => $_POST["password"],
            'roleUser' => 'membre' 
            
        ]);
    }
    catch(PDOException $e){
        $message = $e->getMessage();
        die($message);
    }
}

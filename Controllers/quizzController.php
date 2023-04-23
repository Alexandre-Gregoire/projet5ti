<?php
require_once("Models/quizzModel.php");
if($uri === "/" || $uri === "index.php"){
    $quizzs = selectAllQuizzWithCategorie($pdo);
    require_once "Templates/Questions/voirTousLesQuizz.php";
}elseif($uri === "/creerQuizz"){
    $categories = selectAllCategorie($pdo);
    if(isset($_POST['btnEnvoi']))
    {
        createQuizz($pdo);
        $_SESSION['quizzId'] = $pdo->lastInsertId();
        var_dump($_SESSION);
        createScore($pdo);
        header('Location: creerOuModifierQuestion');
    }
    require_once "Templates/Questions/creerOuModifierQuizz.php";
}elseif ($uri === "/creerOuModifierQuestion") {
    /*createBonneReponse($pdo);
    createQuestion($pdo);*/
    require_once "Templates/Questions/creerOuModifierQuestion.php";


}elseif (str_contains($uri,'quizz?quizzId=')){
    $quizz = selectQuizzQuestion($pdo);
    
    $quizzMauvaiseReponses = selectQuizzMauvaiseReponse($pdo);
    require_once "Templates/Questions/voirUnQuizz.php";
    if(isset($_POST['btnEnvoi']))
    {
        createUser($pdo);
        header('Location: connexion');
    }
}
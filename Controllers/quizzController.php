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
        header('Location: createQuestion');
    }
    require_once "Templates/Questions/creerOuModifierQuizz.php";
}elseif ($uri === "/creerQuestion") {
    createBonneReponse($pdo);
    createQuestion($pdo);



}elseif (str_contains($uri,'quizz?quizzId=')){
    $quizz = selectQuizz($pdo);
    require_once "Templates/Questions/voirUnQuizz.php";
}
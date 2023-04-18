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
        //header('Location: connexion');
    }
    require_once "Templates/Questions/creerOuModifierQuizz.php";
}elseif (str_contains($uri,'quizz?quizzId=')){
    $quizz = selectQuizz($pdo);
    require_once "Templates/Questions/voirUnQuizz.php";
}elseif ($uri === "/creer") {
    
    
}
<?php
require_once("Models/quizzModel.php");
require_once("Models/questionsModel.php");
if($uri === "/" || $uri === "index.php"){
    $quizzs = selectAllQuizzWithCategorie($pdo);
    require_once "Templates/Questions/voirTousLesQuizz.php";
}elseif($uri === "/creerQuizz"){
    $categories = selectAllCategorie($pdo);
    if(isset($_POST['btnEnvoi']))
    {
        createQuizz($pdo);
        $_SESSION['quizzId'] = $pdo->lastInsertId();
        createScore($pdo);
        header('Location: creerOuModifierQuestion');
    }
    require_once "Templates/Questions/creerOuModifierQuizz.php";
}elseif ($uri === "/creerOuModifierQuestion") {
    /*createBonneReponse($pdo);
    createQuestion($pdo);*/
    $quizzInfo = selectQuizzInfo($pdo);
    $counterNbMauvaiseReponse = 0;
    if(isset($_POST['btnEnvoi']))
    {
        var_dump("clicled");
        createBonneReponse($pdo);
        createQuestion($pdo);
        $QuestionId = $pdo->lastInsertId();
        foreach($_POST as $key => $value){
            if(!empty(str_replace(" ","", $value))){
               $counterNbMauvaiseReponse ++; 
                
            }
        }
        $counterNbMauvaiseReponse  -= 2;
        for ($i=1; $i < $counterNbMauvaiseReponse; $i++) { 
            createMauvaiseReponse($pdo,$i,$QuestionId);
        }
    }
    require_once "Templates/Questions/creerOuModifierQuestion.php";

}elseif (str_contains($uri,'quizz?quizzId=')){
    $quizzs = selectQuizzQuestion($pdo);
    $counterNbQuestion = 1; 
    $nbReponse = 1;
    $counterNbMauvaiseReponse = 1;
    require_once "Templates/Questions/voirUnQuizz.php";
    /*if(isset($_POST['btnEnvoi']))
    {
        createUser($pdo);
        header('Location: connexion');
    }*/
}


function recupMauvaiseReponsesShuffle($quizz,$pdo) {
        $reponses = [$quizz->bonneReponseText];
        $quizzMauvaiseReponses = selectQuizzMauvaiseReponse($pdo,$quizz -> questionId);
        foreach($quizzMauvaiseReponses as $quizzMauvaiseReponse) {
            array_push($reponses, $quizzMauvaiseReponse->mauvaiseReponseText);
        }
        shuffle($reponses);
        return $reponses;
}
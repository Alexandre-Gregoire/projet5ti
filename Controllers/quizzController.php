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
    $quizzInfo = selectQuizzInfo($pdo);
    $counterNbMauvaiseReponse = 0;
    if(isset($_POST['btnEnvoi']))
    {
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
        header('Location: creerOuModifierQuestion');
    }
    
    $quizzs = selectQuizzQuestionPourCreation($pdo);
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
}elseif (str_contains($uri,'creerOuModifierQuizz?quizzId=')) {
    $quizzInfo = selectQuizzInfo($pdo);
    $categories = selectAllCategorie($pdo);
    if(isset($_POST['btnEnvoi']))
    {
        ModifierQuizz($pdo);
        header('Location: creerOuModifierQuestion');
    }
    require_once "Templates/Questions/creerOuModifierQuizz.php";

}
elseif (str_contains($uri,'creerOuModifierQuestion?questionId=')){
    $quizzInfo = selectQuizzInfo($pdo);
    $counterNbMauvaiseReponse = 0;
    $quizzs = selectQuizzQuestionPourCreation($pdo);
        if(str_contains($uri,'creerOuModifierQuestion?questionId=')){
            foreach($quizzs as $quizz){
                if($quizz -> questionId == $_GET["questionId"]){
                    $currentQuestion = $quizz;
                }
            }
            
            $currentQuestionReponses = recupMauvaiseReponsesPasShuffle($currentQuestion,$pdo);
            if(isset($_POST['btnEnvoi']))
            {
                
                $counterNbMauvaiseReponse = 0;
                foreach($_POST as $key => $value){
                    if(!empty(str_replace(" ","", $value)) && str_starts_with($key,"MauvaiseReponse")){
                    $counterNbMauvaiseReponse ++; 
                    }
                }

                for ($i=1; $i <= $counterNbMauvaiseReponse; $i++) { 
                    modifierMauvaiseReponse($pdo,$i);
                }
                modifierBonneReponse($pdo);
                modifierQuestion($pdo);
                header('location:/creerOuModifierQuestion');
            }
        }
        require_once "Templates/Questions/creerOuModifierQuestion.php"; 
    
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
function recupMauvaiseReponsesPasShuffle($quizz,$pdo) {
        $reponses = array();
        $quizzMauvaiseReponses = selectQuizzMauvaiseReponse($pdo,$quizz -> questionId);
        foreach($quizzMauvaiseReponses as $quizzMauvaiseReponse) {
            //array_push($reponses, $quizzMauvaiseReponse->mauvaiseReponseText);
            $reponses[$quizzMauvaiseReponse -> mauvaiseReponseId] = $quizzMauvaiseReponse->mauvaiseReponseText;
        }
        return $reponses;
}
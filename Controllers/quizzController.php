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
        $messageErrorCreate = verifDataCreationQuizz();
        if (!$messageErrorCreate) {
            createQuizz($pdo);
            $_SESSION['quizzId'] = $pdo->lastInsertId();
            createScore($pdo);
            header('Location: creerOuModifierQuestion');
        }
        

       
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

}elseif (str_contains($uri,'creerOuModifierQuestion?quizzId=')) {
    $_SESSION['quizzId'] = $_GET['quizzId'];
    header('Location: creerOuModifierQuestion');
}elseif (str_contains($uri,'quizz?quizzId=')){
   
    $quizzs = selectQuizzQuestion($pdo);
    $counterNbQuestion = 1; 
    $nbReponse = 1;
    $counterNbMauvaiseReponse = 1;
    if (!isset($_POST['btnEnvoi'])) $_SESSION['timer'] = time();
    
    $compteurPassageBoucle = 1;
    $score = 0;
    $nbBonneReponse = 0;
    if(isset($_POST['btnEnvoi']))
    {
        foreach($quizzs as $question) 
        {
            $quizzBonneReponse = TestSiBonneReponse($pdo,$question->questionId);
            
            if ($quizzBonneReponse -> bonneReponseText == $_POST['Quizz' . $compteurPassageBoucle]) {
                $nbBonneReponse ++;
            }
            $compteurPassageBoucle += 1;
        }
        if ($compteurPassageBoucle == 1) {
            $compteurPassageBoucle = 2;
        }
        $score = ($nbBonneReponse * (10000/($compteurPassageBoucle-1))) - ($nbBonneReponse * (time() - $_SESSION['timer']) * 10 );
        $_SESSION['score'] = $score;
        $_SESSION['nbBonneReponse'] = $nbBonneReponse;
        $_SESSION['nbQuestion'] = $compteurPassageBoucle-1;
        $_SESSION['temp'] = (time() - $_SESSION['timer']);
        $_SESSION['timer'] = time();
        addScore($pdo,$score);
        $_SESSION['classementScore'] = topScore($pdo);
        header('location:/affichageScore');

    }
    require_once "Templates/Questions/voirUnQuizz.php";
}elseif($uri === "/mesQuizzs"){
    $quizzs = selectAllQuizzUtilisateur($pdo);
    if (isset($_POST['btnEnvoi'])) {
        header('location:/creerOuModifierQuestion');
    }
    require_once "Templates/Questions/voirTousLesQuizz.php";
}elseif($uri === "/affichageScore"){
    $classement = 1;
    $toutLesScore = $_SESSION['classementScore'];
    require_once "Templates/Questions/affichageScore.php";

}elseif (str_contains($uri,'creerOuModifierQuizz?quizzId=')) {
    $quizzInfo = selectQuizzInfo($pdo);
    $categories = selectAllCategorie($pdo);
    if(isset($_POST['btnEnvoi']))
    {
        ModifierQuizz($pdo);
        header('Location: creerOuModifierQuestion');
    }
    require_once "Templates/Questions/creerOuModifierQuizz.php";

}elseif (str_contains($uri,'creerOuModifierQuestion?questionId=')){
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
    
}elseif (str_contains($uri,'deleteQuizz?quizzId=')){
    deleteQuizz($pdo);
    header('location:/mesQuizzs');
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
function verifDataCreationQuizz() {
    
    foreach($_POST as $key => $value){
        if(empty(str_replace(" ","", $value))){
            
            $messageErrorCreate[$key] = "Votre " . $key . " est vide";
        }
        if($key == "NomQuizz" && strlen($value) > 25){
            $messageErrorCreate[$key] = "Veuillez entrez un titre plus petit que 33 caractères";
        }
    }
    if (isset($messageErrorCreate)) {
        return $messageErrorCreate;
    }
    else {
        return false;        
    }
}

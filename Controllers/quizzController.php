<?php
require_once("Models/quizzModel.php");
require_once("Models/categorieModel.php");
if($uri === "/" || $uri === "index.php"){
    $quizzs = selectAllQuizzWithCategorie($pdo);
    require_once "Templates/Questions/voirTousLesQuizz.php";
}elseif($uri === "/creerQuizz"){
    require_once "Templates/Questions/creerQuizz.php";
}
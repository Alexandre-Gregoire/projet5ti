<?php
require_once("Models/quizzModel.php");
if($uri === "/" || $uri === "index.php"){
    selectAllQuizz($pdo);
    require_once "Templates/Questions/acceuil.php";
}
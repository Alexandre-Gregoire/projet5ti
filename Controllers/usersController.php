<?php

$uri = $_SERVER['REQUEST_URI'];

if($uri === "/" || $uri === "index.php"){
    require_once "Templates/Questions/acceuil.php";
}elseif($uri === "/connexion"){
    require_once "Templates/Users/connexion.php";
}elseif ($uri === "/inscription") {
    require_once "Templates/Users/inscription.php";
}
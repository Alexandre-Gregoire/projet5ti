<?php
require_once("Models/categorieModel.php");
if ($uri === "/creerCategorie") {
    if(isset($_POST['btnEnvoi']))
        {
            createCategorie($pdo);
            header('Location: index');             
        }
    require_once "Templates/Categories/creerCategorie.php";
}elseif($uri === "/listeCategorie"){
    $listeCategories = recupToutesCategorie($pdo);
    require_once "Templates/Categories/listeCategorie.php";
}elseif(str_contains($uri,'deleteCategorie?categorieId=')) {
    $categorieId = $_GET["categorieId"];
    deleteCategorie($pdo,$categorieId);  
    header('Location: index');
}

<?php if(isset($_SESSION['user'])) : ?>
    <?php if(!isset($_SESSION['quizzId'])): ?>
    <h1>veuillez d'abord créer le quizz</h1>
    <?php else : ?>
    <form action="" method="post">
        <div class="creerQuizz">
            <div class="connexion">
                <h1>Titre du quizz</h1>
                <h2 class="affichageCreation">wesh</h2>



                
                ddzdzbzduyezffeznnuids
            </div>
            <div class="connexion">
                <h1>Créer Question</h1>
                <div>
                    <h1>Bonne reponse </h1>
                    <input class="inputFormulaire" required type="text" name="BonneReponse" id="BonneReponse" placeholder="Bonne reponse">
                    <h1>Mauvaise reponse</h1>
                    <p>Ne rien mettre si vous ne voulez rien</p>
                    <input class="inputFormulaire" required type="text" name="MauvaiseReponse1" id="MauvaiseReponse1" placeholder="Mauvaise reponse n°1">
                    <input class="inputFormulaire" required type="text" name="MauvaiseReponse2" id="MauvaiseReponse2" placeholder="Mauvaise reponse n°2">
                    <input class="inputFormulaire" required type="text" name="MauvaiseReponse3" id="MauvaiseReponse3" placeholder="Mauvaise reponse n°3">
                </div>
                <div>
                    <input class="buttonFormulaires" required type="submit" name="btnEnvoi" value="Créer" class="">
                </div>
                
            </div>
        </div>
        
        
    <?php endif ?>
</form>
<?php else :?>
<h1>Vous devez vous connecter pour pouvoir creer un quizz</h1>
<?php endif ?>
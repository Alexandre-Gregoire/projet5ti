<?php if(isset($_SESSION['user'])) : ?>
    <?php if(!isset($_SESSION['quizzId'])): ?>
    <h1>veuillez d'abord créer le quizz</h1>
    <?php else : ?>
    <form action="" method="post">
        <div class = "affichageTitreQuestion flex ">
            <div> 
                <img class="image" src="<?= $quizzInfo->categorieImage ?>" alt="">
            </div>
            <div class="ChoixTitre"> 
                <h3><?= $quizzInfo->quizzNom ?></h3>
                <h4><?= $quizzInfo->categorieNom ?></h4>
                
            </div>
            <div class="divButtonModifierQuizz">
                <a href="" class="buttonModifierQuizz">Modifier</a>
            </div>
            


            <div class="ChoixDif">
                <div class="flex">
                    <h4>Difficultée : </h4>

                    <?php for($i = 1; $i <= $quizzInfo->quizzDifficulte/2; $i++) : ?><img class="star" src="Images/etoile.png" alt=""><?php endfor ?></p>
                    <?php if ($quizzInfo->quizzDifficulte%2 != 0) : ?><img class="star" src="Images/demiEtoile.png" alt=""><?php endif ?>
                </div>   
                
                
            </div>
            
            <div class="ChoixDate">
                
            </div>
            <p></p>
        </div>
        <div class="creerQuizz">
            <div class="creationQuestion">
                <h1>Créer Question</h1>
                <input class="inputFormulaire" required type="text" name="question" id="question" placeholder="Question">
                <div>
                    <h1>Bonne reponse </h1>
                    <input class="inputFormulaire" required type="text" name="BonneReponse" id="BonneReponse" placeholder="Bonne reponse">
                    <h1>Mauvaise reponse</h1>
                    <p>Ne rien mettre si vous ne voulez rien</p>
                    <input class="inputFormulaire" type="text" name="MauvaiseReponse1" id="MauvaiseReponse1" placeholder="Mauvaise reponse n°1">
                    <input class="inputFormulaire" type="text" name="MauvaiseReponse2" id="MauvaiseReponse2" placeholder="Mauvaise reponse n°2">
                    <input class="inputFormulaire" type="text" name="MauvaiseReponse3" id="MauvaiseReponse3" placeholder="Mauvaise reponse n°3">
                </div>
                <div>
                    <input class="buttonFormulaires" required type="submit" name="btnEnvoi" value="Créer" class="">
                </div>
            </div>
            
                <div class="containsAffichageQuestion">
                    
                    <?php foreach($quizzs as $quizz) : ?>
                        <div class="affichageQuestion">
                            <div class="questionEtButton">
                                <h1><?= $quizz->questionText ?></h1> 
                                <input class="buttonModifierQuestion" required type="submit" name="btnEnvoi" value="Modifier" class="">
                            </div>
                            <div class="flex justify-content-space-around">
                            <h2 class="affichageQuestionCreationBonne"><?= $quizz->bonneReponseText ?></h2>
                            <?php foreach(recupMauvaiseReponsesPasShuffle($quizz,$pdo) as $index => $reponse) : ?>
                                <h2 class="affichageQuestionCreationFausse"><?= $reponse ?></h2>
                            <?php endforeach ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            
        </div>
        
        
    <?php endif ?>
</form>
<?php else :?>
<h1>Vous devez vous connecter pour pouvoir creer un quizz</h1>
<?php endif ?>
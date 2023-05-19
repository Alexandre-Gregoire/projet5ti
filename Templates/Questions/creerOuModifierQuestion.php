

<?php if(isset($_SESSION['user'])) : ?>
    <?php if(!isset($_SESSION['quizzId'])): ?>
    <h1>veuillez d'abord créer le quizz</h1>
    <?php else : ?>
   
        <div class = "affichageTitreQuestion flex ">
            <div> 
                <img class="image" src="<?= $quizzInfo->categorieImage ?>" alt="">
            </div>
            <div class="ChoixTitre"> 
                <h3><?= $quizzInfo->quizzNom ?></h3>
                <h4><?= $quizzInfo->categorieNom ?></h4>
                
            </div>
            <div class="divButtonModifierQuizz">
            <a href="creerOuModifierQuizz?quizzId=<?= $_SESSION["quizzId"] ?>" class="buttonModifierQuizz">Modifier</a>
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
            <div class="creationQuestionEtValider">
                <div class="creationQuestion">
                    <form action="" method="post">
                        <h1>Créer Question</h1>
                        <input value="<?php if(isset($currentQuestion)) : ?><?= $currentQuestion -> questionText ?><?php endif ?>" class="inputFormulaire" required type="text" name="question" id="question" placeholder="Question">
                        <div>
                            <h1>Bonne reponse </h1>
                            <input value="<?php if(isset($currentQuestion)) : ?><?= $currentQuestion -> bonneReponseText ?> <?php endif ?>" class="inputFormulaire" required type="text" name="BonneReponse" id="BonneReponse" placeholder="Bonne reponse">
                            <h1>Mauvaise reponse</h1>
                            <p>Ne rien mettre si vous ne voulez rien</p>
                            
                            <input value="<?php if(isset($currentQuestion) && count($currentQuestionReponses) >= 1) : ?><?= array_values($currentQuestionReponses)[0] ?><?php endif ?>" class="inputFormulaire" required type="text" name="MauvaiseReponse1" id="MauvaiseReponse1" placeholder="Mauvaise reponse n°1">
                            <input value="<?php if(isset($currentQuestion) && count($currentQuestionReponses) >= 2) : ?><?= array_values($currentQuestionReponses)[1] ?><?php endif ?>" class="inputFormulaire" type="text" name="MauvaiseReponse2" id="MauvaiseReponse2" placeholder="Mauvaise reponse n°2">
                            <input value="<?php if(isset($currentQuestion) && count($currentQuestionReponses) >= 3) : ?><?= array_values($currentQuestionReponses)[2] ?><?php endif ?>" class="inputFormulaire" type="text" name="MauvaiseReponse3" id="MauvaiseReponse3" placeholder="Mauvaise reponse n°3">
                            <input value="<?php if(isset($currentQuestion) && count($currentQuestionReponses) >= 1) : ?><?= array_keys($currentQuestionReponses)[0] ?><?php endif ?>" class="inputFormulaire" type="hidden" name="IdMauvaiseReponse1" id="IdMauvaiseReponse1">
                            <input value="<?php if(isset($currentQuestion) && count($currentQuestionReponses) >= 2) : ?><?= array_keys($currentQuestionReponses)[1] ?><?php endif ?>" class="inputFormulaire" type="hidden" name="IdMauvaiseReponse2" id="IdMauvaiseReponse2">
                            <input value="<?php if(isset($currentQuestion) && count($currentQuestionReponses) >= 3) : ?><?= array_keys($currentQuestionReponses)[2] ?><?php endif ?>" class="inputFormulaire" type="hidden" name="IdMauvaiseReponse3" id="IdMauvaiseReponse3">
                        </div>
                        <div>
                            <input class="buttonFormulaires" required type="submit" name="btnEnvoi" value="Créer" class="">
                        </div>
                    </form>
                </div>
                <form action="post">
                    <div class="buttonFormulairesCréerQuizz">
                    <a href="/" class="buttonFormulairesCréerQuizz">valider</a>
                    </div>
                </form>
                
                
            </div>
            
            
                <div class="containsAffichageQuestion">
                    
                    <?php foreach($quizzs as $quizz) : ?>
                        <div class="affichageQuestion">
                            <div class="questionEtButton">
                                <h1><?= $quizz->questionText ?></h1> 
                                <a href="creerOuModifierQuestion?questionId=<?= $quizz->questionId ?>" class="buttonModifierQuestion">Modifier</a>
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
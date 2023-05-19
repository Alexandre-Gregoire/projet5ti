<h1>Liste des quizzs : </h1>
<div class="ToutLesQuizz">


    <?php foreach($quizzs as $quizz) : ?>
        <div class = "bordureQuizz flex ">
            <div> 
                <img class="image" src="<?= $quizz->categorieImage ?>" alt="">
            </div>
            <div class="ChoixTitre"> 
                <h3><?= $quizz->quizzNom ?></h3>
                <h4><?= $quizz->categorieNom ?></h4>
                
            </div>
            
            <a href="<?php if ($uri === '/mesQuizzs') : ?> creerOuModifierQuestion?quizzId=<?= $quizz->quizzId ?> <?php else : ?> quizz?quizzId=<?= $quizz->quizzId ?>  <?php endif ?>" class="buttonCommencer"><?php if ($uri === '/mesQuizzs') : ?>Modifier<?php else : ?> Commencer <?php endif ?></a>


            <div class="ChoixDif">
                <div class="flex">
                    <h4>Difficultée : </h4>

                    <?php for($i = 1; $i <= $quizz->quizzDifficulte/2; $i++) : ?><img class="star" src="Images/etoile.png" alt=""><?php endfor ?></p>
                    <?php if ($quizz->quizzDifficulte%2 != 0) : ?><img class="star" src="Images/demiEtoile.png" alt=""><?php endif ?>
                </div>   
                
                <h4>Meilleur score : <?= $quizz->score?></h6>
                <h4>Créateur : <?= $quizz->utilisateurPseudo ?></h4>
            </div>
            
            <div class="ChoixDate">
                
            </div>
            <p></p>
        </div>
    <?php endforeach?>
</div>

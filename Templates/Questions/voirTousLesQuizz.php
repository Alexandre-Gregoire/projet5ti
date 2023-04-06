<h1>Bienvenue</h1>

    <?php foreach($quizzs as $quizz) : ?>
        <div class = "bordureQuizz flex justify-content-space-around">
            <div> 
            <img src="<?= $quizz->categorieImage ?>" alt="">
            </div>
            <div class="ChoixTheme">
            <h4><?= $quizz->categorieNom ?></h4>
            </div>
            <div class="ChoixTitre"> 
                <h3><?= $quizz->quizzNom ?></h3>
            </div>

            <div class="ChoixDif">   
                <h4>difficultée du quizz : <?= $quizz->quizzDifficulte ?></h4>
            </div>
            
            <div class="ChoixDate">
                <h6>date de creation : <?= $quizz->quizzDateCreation ?></h6>
            </div>
            <p></p>
        </div>
    <?php endforeach?>


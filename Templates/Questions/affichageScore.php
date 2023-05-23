<div class="flex">
    <div class="connexion">
        <h2>score : <?= $_SESSION['score']?></h2>
        <h2>Bonnes reponse : <?= $_SESSION['nbBonneReponse']?></h2>
        <h2>Mauvaise Reponse : <?= $_SESSION['nbQuestion'] - $_SESSION['nbBonneReponse']?></h2>
        <h2>Temps : <?= $_SESSION['temp']?> secondes</h2>
    </div>
    <div class="connexion">
        
        <?php foreach($toutLesScore as $score):?>
            <h2> <?= $classement ?>. <?= $score->utilisateurPseudo ?> <?= $score->score ?></h2>
            <?php $classement ++; ?>
        <?php endforeach ?>
    </div>
</div>

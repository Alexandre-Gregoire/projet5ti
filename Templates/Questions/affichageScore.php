<div>
    <h2>score : <?= $_SESSION['score']?></h2>
    <h2>Bonnes reponse : <?= $_SESSION['nbBonneReponse']?></h2>
    <h2>Mauvaise Reponse : <?= $_SESSION['nbQuestion'] - $_SESSION['nbBonneReponse']?></h2>
    <h2>Temps : <?= $_SESSION['temp']?> secondes</h2>
</div>
<div>
    
    <?php foreach($toutLesScore as $score):?>
        <p> <?= $classement ?>. <?= $score->utilisateurPseudo ?> <?= $score->score ?></p>

        <?php $classement ++; ?>
    <?php endforeach ?>
</div>
<form action="" method="post">
    <?php foreach ($quizzs as $quizz) : ?>
        <fieldset>
            <legend class="TitreQuestion"><?= $quizz->questionText ?></legend>
            <div class="question">
                <div class="questionHorsTitre">
                    <?php foreach (recupMauvaiseReponsesShuffle($quizz, $pdo) as $index => $reponse) : ?>
                        <div>
                            <input required type="radio" name="Quizz<?= $counterNbQuestion ?>" class="inputRadio" id="Reponse<?= $index ?>-<?= $counterNbQuestion ?>" value="<?= $reponse ?>">
                            <label for="Reponse<?= $index ?>-<?= $counterNbQuestion ?>"><?= $reponse ?></label>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </fieldset>
        <?php $counterNbQuestion++; ?>
    <?php endforeach ?>
    <div class="ValiderQuestions">
        <input class="buttonValider" type="submit" name="btnEnvoi" value="Valider" class="button">
    </div>
</form>

<?php 
    $counterNbQuestion = 1; 
    $nbReponse = 1;
    $counterNbMauvaiseReponse = 1;
?>
<?php foreach($quizz as $quizz) : ?>
    <?php 

        $reponses = [$quizz->bonneReponseText];
        foreach($quizzMauvaiseReponses as $quizzMauvaiseReponse) {
            if($quizz->questionId == $quizzMauvaiseReponse->questionId) {
                array_push($reponses, $quizzMauvaiseReponse->mauvaiseReponseText);
            }
        }

        shuffle($reponses);

        $bonneReponseIndex = array_search($quizz->bonneReponseText, $reponses);
    ?>
    <fieldset>
        <legend class="TitreQuestion"><?= $quizz->questionText ?></legend>
        <div class="question">
            <div class="questionHorsTitre">
                <?php foreach($reponses as $index => $reponse) : ?>
                    <div>
                        <input type="radio" class="inputRadio" name="question<?= $counterNbQuestion ?>" id="Reponse<?= $index ?>-<?= $counterNbQuestion ?>" ?>
                        <label for="Reponse<?= $index ?>-<?= $counterNbQuestion ?>"><?= $reponse ?></label>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </fieldset>
    <?php $counterNbQuestion ++; ?>
<?php endforeach ?>
<div class="ValiderQuestions">
    <input class="buttonValider" type="submit" name="btnEnvoi" value="Valider" class="button">
</div>
<?php if(isset($_SESSION['user'])) : ?>
    <form action="" method="post">
        <div class="connexion">
            <h1>Créer quizz</h1>   
            
            <div>
                <h1>Nom du quizz</h1>
                <input class="inputFormulaire" required type="text" maxlength="25" name="NomQuizz" id="NomQuizz" placeholder="Nom" <?php if (str_contains($uri,'creerOuModifierQuizz?quizzId=')) : ?> value="<?= $quizzInfo->quizzNom ?>" <?php endif ?>>
                <?php if(isset($messageErrorCreate)) : ?> <p><?= $messageErrorCreate['NomQuizz'] ?></p> <?php endif ?>
                <h1>Categorie du quizz</h1>
                <select class="inputFormulaireSelect" name="categorieQuizz" id="categorieQuizz">
                    <?php foreach($categories as $categorie) : //Il faut d'abord creer une page avec quizz et puis ensuite faire les questions et demander a chaque fois si il veut ajouter une question ou terminer le quizz?>
                        <option <?php if (str_contains($uri,'creerOuModifierQuizz?quizzId=') && $quizzInfo->categorieNom == $categorie->categorieNom ) : ?> selected <?php endif ?> value="<?= $categorie->categorieId ?>"><?= $categorie->categorieNom ?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div>
                <h1>Difficulté</h1>
                <input class="inputFormulaireNumber" type="number" required id="difficulte" name="difficulte" min="1" max="10" <?php if (str_contains($uri,'creerOuModifierQuizz?quizzId=')) : ?> value="<?= $quizzInfo->quizzDifficulte ?>" <?php endif ?>>
                <?php if(isset($messageErrorCreate)) : ?> <p><?= $messageErrorCreate['difficulte'] ?></p> <?php endif ?>
            </div>
            <div>
                <input class="buttonFormulaires"  type="submit" name="btnEnvoi" value="<?php if (str_contains($uri,'creerOuModifierQuizz?quizzId=')) : ?>Modifier<?php else : ?>Créer<?php endif ?>" class="">
            </div>
            
        </div>
</form>









<?php else :?>
<h1>Vous devez vous connecter afin de pouvoir creer un quizz</h1>
<?php endif ?>
<?php if(isset($_SESSION['user'])) : ?>
    <form action="" method="post">
        <div class="connexion">
            <h1>Créer quizz</h1>   
            <h5>Complétez les champs</h5>
            <div>
                <h1>Nom du quizz</h1>
                <input class="inputFormulaire" required type="text" name="NomQuizz" id="pseudo" placeholder="Nom">
                <h1>Categorie du quizz</h1>
                <select name="" id="">
                    <?php foreach($categories as $categorie) : //Il faut d'abord creer une page avec quizz et puis ensuite faire les questions et demander a chaque fois si il veut ajouter une question ou terminer le quizz?>
                        <option value="<?= $categorie->categorieNom ?>"><?= $categorie->categorieNom ?></option>
                    <?php endforeach?>

                </select>
            </div>
            <div>
                <h1>Bonne reponse </h1>
                <input class="inputFormulaire" required type="text" name="BonneReponse" id="BonneReponse" placeholder="Bonne reponse">
                <h1>Mauvaise reponse</h1>
                <input class="inputFormulaire" required type="text" name="MauvaiseReponse1" id="MauvaiseReponse1" placeholder="Mauvaise reponse n°1">
                <input class="inputFormulaire" required type="text" name="MauvaiseReponse2" id="MauvaiseReponse2" placeholder="Mauvaise reponse n°2">
                <input class="inputFormulaire" required type="text" name="MauvaiseReponse3" id="MauvaiseReponse3" placeholder="Mauvaise reponse n°3">
            </div>
            <div>
                <h1>Difficulté</h1>
                <input type="number" id="difficulte" name="difficulte" min="1" max="10">
            </div>
            <div>
            <input class="buttonFormulaires" type="submit" name="btnEnvoi" value="Login" class="button">
            </div>
            <div>
                <a href="inscription" class="signUp">Sign up </a>
            </div>
            
        </div>
</form>









<?php else :?>
<h1>Vous devez vous connecter pour pouvoir creer un quizz</h1>
<?php endif ?>
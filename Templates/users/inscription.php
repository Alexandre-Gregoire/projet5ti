<form action="" method="post">
        <div class="connexion">
            <h1><?php if(isset($_SESSION["user"])) : ?>Modifier<?php else : ?>Inscription<?php endif ?></h1>   
            <h4>Complete the fields</h4>
            <div>
                <h5>Pseudo</h5>
                <input required class="inputFormulaire" type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php if(isset($_SESSION["user"])) : ?><?= $_SESSION["user"]-> utilisateurPseudo?><?php endif ?>">
                <?php if(isset($messageErrorLogin['pseudo'])) : ?> <p><?= $messageErrorLogin['pseudo'] ?></p> <?php endif ?>
            </div>
            <div>
                <h5>Email</h5>
                <input required class="inputFormulaire" type="text" name="mail" id="mail" placeholder="Email" value="<?php if(isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->utilisateurEmail ?><?php endif ?>">
                <?php if(isset($messageErrorLogin['mail'])) : ?> <p><?= $messageErrorLogin['mail'] ?></p> <?php endif ?>
            </div>
            <div>
                <h5>Mot de passe</h5>
                <input required class="inputFormulaire" type="password" name="password" id="password" placeholder="password" value="<?php if(isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->utilisateurMdp ?><?php endif ?>">
                <?php if(isset($messageErrorLogin['password'])) : ?> <p><?= $messageErrorLogin['password'] ?></p> <?php endif ?>
            </div>
            <input type="submit" name="btnEnvoi" value="<?php if(isset($_SESSION["user"])) : ?>Modifier<?php else : ?>Inscription<?php endif ?>" class="buttonFormulaires">
            <a href="connexion" class="signUp"></a>
        </div>
</form>
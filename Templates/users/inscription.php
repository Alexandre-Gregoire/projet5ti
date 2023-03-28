<form action="" method="post">
        <div class="mid">
            <h1><?php if(isset($_SESSION["user"])) : ?>Modifier<?php else : ?>Inscription<?php endif ?></h1>   
            <h4>Complete the fields</h4>
            <div>
                <input  type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php if(isset($_SESSION["user"])) : ?><?= $_SESSION["user"]-> utilisateurPseudo?><?php endif ?>">
                <?php if(isset($messageErrorLogin['pseudo'])) : ?> <p><?= $messageErrorLogin['pseudo'] ?></p> <?php endif ?>
            </div>
            <div>
                <input  type="text" name="mail" id="mail" placeholder="Email" value="<?php if(isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->utilisateurEmail ?><?php endif ?>">
                <?php if(isset($messageErrorLogin['mail'])) : ?> <p><?= $messageErrorLogin['mail'] ?></p> <?php endif ?>
            </div>
            <div>
                <input  type="password" name="password" id="password" placeholder="password" value="<?php if(isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->utilisateurMdp ?><?php endif ?>">
                <?php if(isset($messageErrorLogin['password'])) : ?> <p><?= $messageErrorLogin['password'] ?></p> <?php endif ?>
            </div>
            <input type="submit" name="btnEnvoi" value="<?php if(isset($_SESSION["user"])) : ?>Modifier<?php else : ?>Inscription<?php endif ?>" class="button">
            <a href="connexion" class="signUp"></a>
        </div>
</form>
<form action="" method="post">
        <div class="connexion">
            <h1>Connexion</h1>   
            <h5>Entrer vos identifiants</h5>
            <div>
                <h5>Pseudo</h5>
                <input class="inputFormulaire" required type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
            </div>
            <div>
                <h5>Mot de passe</h5>
                <input class="inputFormulaire" required type="password" name="password" id="password" placeholder="Mot de passe">
                <?php if(isset($messageErrorLogin)) : ?> <p><?= $messageErrorLogin ?></p> <?php endif ?>
            </div>
            <div>
            <input class="buttonFormulaires" type="submit" name="btnEnvoi" value="Login" class="button">
            </div>
            <div>
                <a href="inscription" class="signUp">Sign up </a>
            </div>
            
        </div>
</form>

<form action="inscription" method="post">
        <div class="mid">
            <h1>Inscription</h1>   
            <h4>Complete the fields</h4>
            <div>
                <input  type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
                <?php if(isset($messageErrorLogin['pseudo'])) : ?> <p><?= $messageErrorLogin['pseudo'] ?></p> <?php endif ?>
            </div>
            <div>
                <input  type="text" name="mail" id="mail" placeholder="Email">
                <?php if(isset($messageErrorLogin['mail'])) : ?> <p><?= $messageErrorLogin['mail'] ?></p> <?php endif ?>
            </div>
            <div>
                <input  type="password" name="password" id="password" placeholder="password">
                <?php if(isset($messageErrorLogin['password'])) : ?> <p><?= $messageErrorLogin['password'] ?></p> <?php endif ?>
            </div>
            <input type="submit" name="btnEnvoi" value="Sign up">
            <a href="connexion" class="signUp">Login</a>
        </div>
</form>
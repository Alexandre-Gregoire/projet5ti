<div class="message">


    <?php foreach($messages as $message) : ?>
    <div class="flex <?php if($message->utilisateurId == $_SESSION['user']->utilisateurId) : ?>droite <?php endif ?>">
        <title>
        </title>
        <h2 title="le <?= $message->messageDate ?> à <?= $message->messageHeure ?>"><?= $message->messageText ?></h2>
        <a class="aChat" href="<?php if($message->messageText == 'message suprimmer par son redacteur') : ?>delete?messageId=<?php else : ?>modify?messageId=<?php endif ?><?= $message->messageId ?>">X</a>
    </div>
    <?php endforeach ?>



    <form action="" method="post">
        <textarea name="textMessage" id="textMessage" cols="33" rows="5" ></textarea>
        <?php if (isset($messageErrorLogin)) : ?> <p>veuillez remplir les champs</p> <?php else : ?> <p></p> <?php endif ?>
        <input type="submit" name="btnEnvoi" type="button" value="valider" class="buttonChat">
    </form>
</div>


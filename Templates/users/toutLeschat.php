<?php foreach($users as $user) : ?>
<div class="flex">
    
    <h2><?= $user->utilisateurPseudo ?></h2>
    <a class="aChat" href="chat?utilisateurId=<?= $user->utilisateurId ?>">discuter</a>
</div>
<?php endforeach ?>

<form action="" method="post">
    <select name="utilisateurGroupe[]" multiple id="utilisateurGroupe">
        <?php foreach($users as $user) : ?>
            <option value = '<?= $user->utilisateurId ?>'><?= $user->utilisateurPseudo ?></option>

        <?php endforeach ?>
    </select>
    <input class="buttonValider" type="submit" name="btnEnvoi" value="Valider" class="button">
</form>

<?php foreach($groupes as $groupe) : ?>
<div class="flex">
    
    <h2>Groupe numéro : </h2>
    <a class="aChat" href="chat?conversationId=<?= $groupe->conversationId ?>"><?= $groupe->conversationId ?></a>
</div>
<?php endforeach ?>
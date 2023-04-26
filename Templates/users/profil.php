

    <h1>Profil Utilisateur</h1>
    <h2>Informations de l'utilisateur</h2>
    <ul>
        <li><strong>Pseudo :</strong> <?= $_SESSION["user"]->utilisateurPseudo ?></li>
        <li><strong>Mot de passe :</strong> *********</li>
        <li><strong>Email :</strong> <?= $_SESSION["user"]->utilisateurEmail ?></li>
        <li><strong>Rôle :</strong> <?= $_SESSION["user"]->utilisateurRole ?></li>
    </ul>

    


<a href="/modifyProfil">Modifier votre profil</a>
<a href="/deleteProfil">suprimer votre profil</a>
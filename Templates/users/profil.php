<h1>Votre page profil</h1>
<ol>
    <div>
        <li>Pseudo</li>
        <p><?= $_SESSION["user"]->utilisateurPseudo ?></p>
    </div>
    <div>
        <li>Mail</li>
        <p><?= $_SESSION["user"]->utilisateurEmail ?></p>
    </div>
    
</ol>

<a href="/modifyProfil">Modifier votre profil</a>
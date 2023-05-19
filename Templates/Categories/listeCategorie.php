<h1>Liste des categories : </h1>
<div class="ToutLesQuizz">
    <?php foreach($listeCategories as $categorie) : ?>
        <div class = "categorieBox flex">
            <div> 
                <img class="image" src="<?= $categorie->categorieImage ?>" alt="">
            </div>
            <div>
                <h1><?= $categorie->categorieNom ?></h4>
            </div>
            <div>
            
                <a href="/deleteCategorie?categorieId=<?= $categorie -> categorieId?>">Suprimer</a>
            </div>
            
            
            <p></p>
        </div>
    <?php endforeach?>
</div>

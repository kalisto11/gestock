<h1 class="text-center">Informations sur le Bon d'Entrée</h1>
<div class="container"> 
      <div class="form-group">
        <label for="reference">Référence</label>
        <p class="zonegrise" ><?= $bonentree->reference ?></p>
      </div>
      <div class="form-group">
        <label for="reference">Date</label>
        <p class="zonegrise"><?= $bonentree->date ?></p>
    </div>
      <div class="form-group mt-3">
        <label for="fournisseur">Fournisseur</label>
        <p class="zonegrise"><?= $bonentree->fournisseur ?></p>      
      </div>
      <div>
        <label for="">Dotations</label>
        <?php if ($bonentree->dotations != null): ?>
        <?php foreach ($bonentree->dotations as $dotation): ?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                <p class="zonegrise"><?= htmlspecialchars($dotation->article->nom) ?></p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <p class="zonegrise"><?= htmlspecialchars($dotation->quantite) ?></p>
                </div>
            </div> 
        </div>
        <?php endforeach ; ?>
        <?php endif ; ?>         
    </div>

      <div>
        <a href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>"class="btn btn-info">Modifier</a>
        <a href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>"class="btn btn-danger">Supprimer</a>
    </div>
    </div>
    <div class="mt-5">
        <p>
            <a class="btn btn-warning float-right" href="/gestock/bonsentree/liste">Voir la liste des Bons d'entrée</a>
        </p>
    </div>
</div>


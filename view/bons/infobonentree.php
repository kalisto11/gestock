<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Information sur le bon d'entrée</h2>
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
        <p class="zonegrise"><?= $bonentree->fournisseur->nom ?></p>      
      </div>
      <div>
        <label for="">Dotations</label>
        <?php if ($bonentree->dotations != null): ?>
        <?php foreach ($bonentree->dotations as $dotation): ?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                <p class="zonegrise text-right"><?= htmlspecialchars($dotation->article->nom) ?></p>
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


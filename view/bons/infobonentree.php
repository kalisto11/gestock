<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Information sur le bon d'entrée</h2>
<div class="container-fluid"> 
  <div class="row">
    <div class="col-sm-3">

      <div>
        <h6>Numéro du bon</h6>
        <p class="zonegrise" ><?= $bonentree->reference ?></p>
      </div>

      <div>
        <h6>Date du bon d'entrée</h6>
        <p class="zonegrise"><?= $bonentree->date ?></p>
      </div>

      <div>
        <h6>Numéro de la facture</h6>
        <p class="zonegrise" ><?= $bonentree->numeroFacture ?></p>
      </div>

      <div>
        <h6>Date de la facture</h6>
        <p class="zonegrise"><?= $bonentree->dateFacture ?></p>
      </div>

      <div class="mt-3">
        <h6>Fournisseur</h6>
        <p class="zonegrise"><a href="/gestock/fournisseurs/consulter/<?= $bonentree->idFournisseur ?>"><?= $bonentree->nomFournisseur ?></a></p>      
      </div>

    </div>
    
    <div class="col-sm-9">

      <div>
        <h6>Dotations</h6>
        <?php if ($bonentree->dotations != null): ?>
        <table class="table table-striped table-borderless table-hover table-sm">
          <tr>
            <th class="th-md">Article</th>
            <th>Quantité</th>
            <th>Prix untitaire</th>
            <th>Prix total</th>
          </tr>
          <?php foreach ($bonentree->dotations as $dotation): ?>
          <tr>
            <td><?= htmlspecialchars($dotation->nomArticle) ?></td>
            <td><?= htmlspecialchars($dotation->quantite) ?></td>
            <td><?= htmlspecialchars($dotation->prix) ?></td>
            <td><?= htmlspecialchars($dotation->total) ?></td>
          </tr>
          <?php endforeach ; ?> 
          <tr class="font-weight-bold">
            <td colspan="3">Total général</td>
            <td><?= $bonentree->totalGeneral ?></td>
          </tr>  
        </table>
        <?php endif ; ?>    
      </div>

      <div class="mt-5 text-right">
        Dernière modification le <?= $bonentree->dateModification ?> par <?= $bonentree->nomModificateur ?>
      </div>

      <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>  
      <div class="text-right mt-5">
      <a href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>" class="btn btn-info">Modifier</a>
      <a href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>" class="btn btn-danger suppr">Supprimer</a>
      </div>
      <?php endif ; ?>
      <div class="mt-5">
        <p>
            <a class="btn btn-secondary float-right" href="/gestock/bonsentree/liste">Voir la liste des bons d'entrée</a>
        </p>
      </div>
    </div>
  </div>
</div>



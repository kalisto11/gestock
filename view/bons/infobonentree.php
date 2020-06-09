<?php require VIEW . 'infos/notifications.php'; ?>

<h2>Information sur le bon d'entrée</h2>
<div class="container-fluid"> 
<?php if (isset($bonentree)) : ?>
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
      <div>
        <h6>Fournisseur</h6>
        <p class="zonegrise"><a href="/gestock/fournisseurs/consulter/<?= $bonentree->idFournisseur ?>"><?= $bonentree->nomFournisseur ?></a></p>      
      </div>

    </div>
    
    <div class="col-sm-9">
      <div>
        <h5 class="text-center">Dotations</h5>
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
            <td><a href="/gestock/grandlivres/consulter/<?= $dotation->idArticle ?>"><?= htmlspecialchars($dotation->nomArticle) ?></a></td>
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
      <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>  
      <div class="text-right mt-5">
      <a href="/gestock/fpdf/printBonEntree.php?id=<?= $bonentree->id ?>" class="btn btn-sm btn-secondary" target="_blank">Imprimer</a>
      <a href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>" class="btn btn-sm btn-info">Modifier</a>
      <a href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>" class="btn btn-sm btn-danger suppr">Supprimer</a>
      </div>
      <?php endif ; ?>
      <div class="mt-5">
        <?php if ($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>
        <a class="btn btn-success btn-sm ml-5" href="/gestock/bonsentree/ajouter"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon d'entrée</a>
        <?php endif ; ?>
        <a class="btn btn-sm btn-secondary float-right" href="/gestock/bonsentree/liste">Voir la liste des bons d'entrée</a>
      </div>
    </div>
  </div>
</div>
<?php else : ?>
<div>
<?php echo "Le bon n'existe plus"; ?>
</div>
<a class="btn btn-secondary float-right" href="/gestock/bonsentree/liste">Voir la liste des bons d'entrée</a>
<?php endif ; ?>




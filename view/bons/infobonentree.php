<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Information sur le bon d'entrée</h2>
<div class="container"> 
  <div class="row">
    <div class="col-sm-3">
      <div>
        <h5>Référence</h5>
        <p class="zonegrise" ><?= $bonentree->reference ?></p>
      </div>
      <div>
        <h5>Date</h5>
        <p class="zonegrise"><?= $bonentree->date ?></p>
      </div>
      <div class="mt-3">
        <h5>Fournisseur</h5>
        <p class="zonegrise"><?= $bonentree->fournisseur->nom ?></p>      
      </div>
    </div>
    
    <div class="col-sm-9">

      <div>
        <h5>Dotations</h5>
        <?php if ($bonentree->dotations != null): ?>
          
          <table class="table table-striped table-bordered table-hover table-sm">
          <tr>
            <th class="th-md">Article</th>
            <th>Quantité</th>
            <th>Prix untitaire</th>
            <th>Prix total</th>
          </tr>
          <?php foreach ($bonentree->dotations as $dotation): ?>
            <tr>
              <td><?= htmlspecialchars($dotation->article->nom) ?></td>
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

    </div>
  </div>
      
  <div class="mt-5">
      <a href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>"class="btn btn-info">Modifier</a>
      <a href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>"class="btn btn-danger suppr">Supprimer</a>
  </div>
  </div>
  <div>
      <p>
          <a class="btn btn-secondary float-right" href="/gestock/bonsentree/liste">Voir la liste des bons d'entrée</a>
      </p>
  </div>
</div>


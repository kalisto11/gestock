<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Information sur le bon de sortie</h2>
<div class="container"> 
  <div class="row">
    <div class="col-sm-3">
        <div>
            <h6>Numéro du bon</h6>
            <p class="zonegrise">
            <?= $bonsortie->reference ?>
            </p>
        </div>
        <div>
            <h6>Date</h6>
            <p class="zonegrise"><?= $bonsortie->date ?></p>
        </div>
        <div>
            <h6>Bénéficiaire</h6>
            <p class="zonegrise"><a href="/gestock/personnels/consulter/<?=$bonsortie->idBeneficiaire?>"><?= $bonsortie->nomBeneficiaire ?></a></p>        
        </div>
    </div>
    <div class="col-sm-9">
      <div>
        <h6>Dotations</h6>
        <?php if ($bonsortie->dotations != null): ?>

        <table class="table table-striped table-borderless table-hover table-sm">
          <tr>
            <th class="th-md">Article</th>
            <th>Quantité</th>
            <th>Prix untitaire</th>
            <th>Prix total</th>
          </tr>
          <?php foreach ($bonsortie->dotations as $dotation): ?>
          <tr>
            <td><?= htmlspecialchars($dotation->nomArticle) ?></td>
            <td><?= htmlspecialchars($dotation->quantite) ?></td>
            <td><?= htmlspecialchars($dotation->prix) ?></td>
            <td><?= htmlspecialchars($dotation->total) ?></td>
          </tr>
          <?php endforeach ; ?>
          <tr class="font-weight-bold">
            <td colspan="3">Total général</td>
            <td><?= $bonsortie->totalGeneral ?></td>
          </tr>  
        </table>

        <?php endif ; ?>   
      </div>
      <div class="mt-5 text-right">
        Dernière modification le <?= $bonsortie->dateModification ?> par <?= $bonsortie->nomModificateur ?>
      </div> 
      <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
      <div class="text-right mt-5">
        <a href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>" class="btn btn-info">Modifier</a>
        <a href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>" class="btn btn-danger suppr">Supprimer</a>
      </div>
      <?php endif; ?>
      <div class="mt-5">
        <p>
          <a class="btn btn-secondary float-right" href="/gestock/bonssortie/liste">Voir la liste des bons de sortie</a>
        </p>
      </div>
    </div>      
  </div>
</div>
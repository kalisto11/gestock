<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Information sur le bon de sortie</h2>
<div class="container"> 
    <div class="row">
        <div class="col-sm-3">
            <div>
                <h5>Référence</h5>
                <p class="zonegrise">
                <?= $bonsortie->reference ?>
                </p>
            </div>
            <div>
                <h5>Date</h5>
                <p class="zonegrise"><?= $bonsortie->date ?></p>
            </div>
            <div>
                <h5>Bénéficiaire</h5>
                <p class="zonegrise"><?= $bonsortie->beneficiaire->prenom  ?> <?=$bonsortie->beneficiaire->nom ?></p>        
            </div>
        </div>
        <div class="col-sm-9">
        <div>
        <h5>Dotations</h5>
        <?php if ($bonsortie->dotations != null): ?>

          <table class="table table-striped table-bordered table-hover table-sm">
          <tr>
            <th class="th-md">Article</th>
            <th>Quantité</th>
            <th>Prix untitaire</th>
            <th>Prix total</th>
          </tr>
          <?php foreach ($bonsortie->dotations as $dotation): ?>
            <tr>
              <td><?= htmlspecialchars($dotation->article->nom) ?></td>
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
        </div>      
    </div>
    <div class="mt-5">
        <a href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"class="btn btn-info">Modifier</a>
        <a href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"class="btn btn-danger suppr">Supprimer</a>
    </div>
    <div>
        <p>
            <a class="btn btn-secondary float-right" href="/gestock/bonssortie/liste">Voir la liste des bons de sortie</a>
        </p>
    </div>
</div>
<?php require VIEW . 'infos/notifications.php'; ?>

<h1 class="text-center">Modifier le un bon de sortie</h1>

<div class="container"> 
    <form method="post" action="/gestock/bonssortie/traitement-bonsortie">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control" value="<?= $bonsortie->reference ?>">
      </div>

      <div class="form-group mt-3">
        <label for="beneficiaire">Bénéficiaire</label>
        <select name="beneficiaire" id="beneficiaire" class="form-control">
          <option value="null">----------------------------------</option>
          <?php foreach($personnels as $personnel): ?>
          <option value="<?= $personnel->id ?>" <?php if ($personnel->id == $bonsortie->beneficiaire->id){echo 'selected="selected"';}?>><?= $personnel->prenom?> <?= $personnel->nom ?></option>
          <?php endforeach ; ?>
        </select>
      </div>
      
      <?php 
      $i = 1;
      foreach ($bonsortie->dotations as $dotation) : ?>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="article1">Article</label>
              <select name="article<?= $i ?>" id="article<?= $i ?>" class="form-control">
                <option value="null">-----------------------------------------------</option>
                <?php foreach($articles as $article): ?>
                <option value="<?= $article->id ?>" <?php if ($article->id == $dotation->article->id){echo 'selected="selected"';} ?>><?= $article->nom ?></option>
                <?php endforeach ; ?>
              </select>
            </div> 
          </div>
          <div class="col">
            <div class="form-group">
              <label for="quantite">Quantité</label>
              <input type="number" name="quantite" id="quantite" value="<?= $dotation->quantite ?>" class="form-control">
            </div>
          </div>
        </div> 
      <?php 
      $i++;
      endforeach ; ?>
      
      <input type="hidden" name="operation" value="modifier">
      <input type="hidden" name="id" value="<?= $bonsortie->id ?>">
      
      <div class="mt-5">
        <input type="submit" value="Modifier" class="btn btn-info">
        <a href="/gestock/bonssortie/liste" class="btn btn-danger">Annuler</a>
      </div>    
    </form>
  </div>



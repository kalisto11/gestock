<?php require VIEW . 'infos/notifications.php'; ?>
<h2 class="mt-5 text-center">Modifier le bon d'entrée</h2>
<div class="container"> 
    <form method="post" action="/gestock/bonsentree/traitement-bonentree">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control" value="<?= $bonentree->reference ?>">
      </div>
    
      <div class="form-group">
      <label for="fournisseur">Fournisseur</label>
      <select name="fournisseur" id="fournisseur" class="form-control">
        <option value="null">Choisir un fournisseur</option>
        <?php foreach ($fournisseurs as $fournisseur) : ?>
        <option value="<?= $fournisseur->id ?>" <?php if ($fournisseur->id == $bonentree->fournisseur->id){echo 'selected="selected"' ;} ?>><?= $fournisseur->nom ?></option>
        <?php endforeach ; ?>
      </select>
      </div>

      <?php 
      $i = 1;
      foreach ($bonentree->dotations as $dotation) : ?>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="article<?= $i ?>">Article</label>
              <select name="article<?= $i ?>" id="article<?= $i ?>" class="form-control">
                <option value="null">Choisir un article</option>
                <?php foreach($articles as $article): ?>
                <option value="<?= $article->id ?>" <?php if ($article->id == $dotation->article->id){echo 'selected="selected"';} ?>><?= $article->nom ?></option>
                <?php endforeach ; ?>
              </select>
            </div> 
          </div>
          <div class="col">
            <div class="form-group">
              <label for="quantite<?= $i ?>">Quantité</label>
              <input type="number" name="quantite<?= $i ?>" id="quantite<?= $i ?>" value="<?= $dotation->quantite ?>" class="form-control" placeholder="Quantité de l'article">
            </div>
          </div>
        </div> 
      <?php 
      $i++;
      endforeach ; ?>

      <?php if ($i < 10){
        for ($i = $i ; $i <= 10; $i ++) : ?>
          <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="article<?= $i ?>">Article</label>
              <select name="article<?= $i ?>" id="article<?= $i ?>" class="form-control">
                <option value="null">Choisir un article</option>
                <?php foreach($articles as $article): ?>
                <option value="<?= $article->id ?>"><?= $article->nom ?></option>
                <?php endforeach ; ?>
              </select>
            </div> 
          </div>
          <div class="col">
            <div class="form-group">
              <label for="quantite<?= $i ?>">Quantité</label>
              <input type="number" name="quantite<?= $i ?>" id="quantite<?= $i ?>" class="form-control" placeholder="Quantité de l'article">
            </div>
          </div>
        </div> 
        <?php endfor ;
      }
      ?>
      
      <input type="hidden" name="operation" value="modifier">
      <input type="hidden" name="id" value="<?= $bonentree->id ?>">
      
      <div class="mt-5">
        <input type="submit" value="Modifier" class="btn btn-info">
        <a href="/gestock/bonsentree/liste" class="btn btn-danger">Annuler</a>
      </div>    
    </form>
  </div>


<h1 class="text-center">Ajouter un bon de sortie</h1>
<div class="container"> 
    <form method="post" action="/gestock/bonssortie/traitement-bonsortie">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control">
      </div>
      <?php for ($i = 0; $i < 10; $i++) :?>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="article1">Article </label>
            <select name="article<?php $i+1 ?>" id="article" class="form-control">
              <option value="null">-----------------------------------------------</option>
              <?php foreach($articles as $article): ?>
              <option value="<?= $article->id ?>"><?= $article->nom ?></option>
              <?php endforeach ; ?>
            </select>
          </div> 
        </div>
        <div class="col">
          <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
      </div> 
      <?php endfor ; ?>
      <div class="form-group mt-3">
        <label for="beneficiaire">Bénéficiaire</label>
        <select name="beneficiaire" id="beneficiaire" class="form-control">
          <option value="null">----------------------------------</option>
          <?php foreach($personnels as $personnel): ?>
          <option value="<?= $personnel->id ?>">  <?= $personnel->prenom?>  <?= $personnel->nom ?></option>
          <?php endforeach ; ?>
        </select>
      </div>
  
      <input type="hidden" name="operation" value="ajouter">
  
      <input type="submit" value="Ajouter" class="btn btn-success">
      <a href="/gestock/bonssortie/liste" class="btn btn-danger">Annuler</a>    
    </form>
  </div>



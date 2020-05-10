<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="text-center">Ajouter un bon de sortie</h2>
<div class="container"> 
    <form method="post" action="/gestock/bonssortie/traitement-bonsortie">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control" placeholder="référence du bon de sortie" required>
      </div>

      <div class="form-group mt-3">
        <label for="beneficiaire">Bénéficiaire</label>
        <select name="beneficiaire" id="beneficiaire" class="form-control">
          <option value="null">Choisir un bénéficiare</option>
          <?php foreach($personnels as $personnel): ?>
          <option value="<?= $personnel->id ?>">  <?= $personnel->prenom?>  <?= $personnel->nom ?></option>
          <?php endforeach ; ?>
        </select>
      </div>

      <h6>Dotations</h6>
      
      <?php for ($i = 1; $i <= 10; $i++) :?>
        <div class="row row-color">

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
              <input type="number" name="quantite<?= $i ?>" id="quantite<?= $i ?>" class="form-control" placeholder="Saisir un nombre">
            </div>
          </div>
          
          <div class="col">
            <div class="form-group">
              <label for="prix<?= $i ?>">Prix unitaire</label>
              <input type="number" name="prix<?= $i ?>" id="prix<?= $i ?>" class="form-control" placeholder="Saisir le prix unitaire">
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="total<?= $i ?>">Prix total</label>
              <input type="text" name="total<?= $i ?>" id="total<?= $i ?>" class="form-control" value="0" disabled>
            </div>
          </div>

        </div> 
      <?php endfor ; ?>
  
      <input type="hidden" name="operation" value="ajouter">

      <div class="row zonegrise">
        <div class="col-sm-8">
          <p>Total général</p>
        </div>
        <div class="col-sm-4 text-right">
          <p class="totalgeneral" id="totalGeneral">0</p>
        </div>
      </div> 
      
      <div class="mt-5">
        <input type="submit" value="Ajouter" class="btn btn-success">
        <a href="/gestock/bonssortie/liste" class="btn btn-danger">Annuler</a>
      </div>    
    </form>
  </div>



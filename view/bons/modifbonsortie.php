<?php require VIEW . 'infos/notifications.php'; ?>

<h2>Modifier le bon de sortie</h2>

<div class="container"> 
    <form method="post" action="/gestock/bonssortie/traitement-bonsortie">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control form-control-sm" value="<?= $bonsortie->reference ?>">
      </div>

      <div class="form-group mt-3">
        <label for="beneficiaire">Bénéficiaire</label>
        <select name="beneficiaire" id="beneficiaire" class="form-control form-control-sm">
          <option value="null">Choisir un bénéficiaire</option>
          <?php foreach($personnels as $personnel): ?>
          <option value="<?= $personnel->id ?>" <?php if ($personnel->id == $bonsortie->idBeneficiaire){echo 'selected="selected"';}?>><?= $personnel->prenom?> <?= $personnel->nom ?></option>
          <?php endforeach ; ?>
        </select>
      </div>
      
      <?php 
      $i = 1;
      foreach ($bonsortie->dotations as $dotation) : ?>
        <div class="row row-color">

          <div class="col">
            <div class="form-group">
              <label for="article<?= $i ?>">Article</label>
              <select name="article<?= $i ?>" id="article<?= $i ?>" class="form-control form-control-sm">
                <option value="null">Choisir un article</option>
                <?php foreach($articles as $article): ?>
                <option value="<?= $article->id ?>" <?php if ($article->id == $dotation->idArticle){echo 'selected="selected"';} ?>><?= $article->nom ?></option>
                <?php endforeach ; ?>
              </select>
            </div> 
          </div>

          <div class="col">
            <div class="form-group">
              <label for="quantite<?= $i ?>">Quantité</label>
              <input type="number" name="quantite<?= $i ?>" id="quantite<?= $i ?>" value="<?= $dotation->quantite ?>" class="form-control form-control-sm" placeholder="Saisir un nombre">
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="prix<?= $i ?>">Prix unitaire</label>
              <input type="number" name="prix<?= $i ?>" id="prix<?= $i ?>" value="<?= $dotation->prix ?>" class="form-control form-control-sm" placeholder="Saisir le prix unitaire">
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="total<?= $i ?>">Prix total</label>
              <input type="text" name="total<?= $i ?>" id="total<?= $i ?>" value="<?= $dotation->total ?>" class="form-control form-control-sm" value="" disabled>
            </div>
          </div>

        </div> 
      <?php 
      $i++;
      endforeach ; ?>

      <?php if ($i < 10){
        for ($i = $i ; $i <= 10; $i ++) : ?>
          <div class="row row-color">

          <div class="col">
            <div class="form-group">
              <label for="article<?= $i ?>">Article</label>
              <select name="article<?= $i ?>" id="article<?= $i ?>" class="form-control form-control-sm">
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
              <input type="number" name="quantite<?= $i ?>" id="quantite<?= $i ?>" class="form-control form-control-sm" placeholder="Saisir un nombre">
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="prix<?= $i ?>">Prix unitaire</label>
              <input type="number" name="prix<?= $i ?>" id="prix<?= $i ?>" class="form-control form-control-sm" placeholder="Saisir le prix unitaire">
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="total<?= $i ?>">Prix total</label>
              <input type="text" name="total<?= $i ?>" id="total<?= $i ?>" class="form-control form-control-sm" value="0" disabled>
            </div>
          </div>

        </div> 
        <?php endfor ;
      }
      ?>
      
      <input type="hidden" name="operation" value="modifier">
      <input type="hidden" name="id" value="<?= $bonsortie->id ?>">

      <div class="row zonegrise">
        <div class="col-sm-8 text-left">
          <p>Total général</p>
        </div>
        <div class="col-sm-4 text-right">
          <p class="totalgeneral" id="totalGeneral"><?= $bonsortie->totalGeneral ?></p>
        </div>
      </div> 
      
      <div class="mt-5">
        <input type="submit" value="Modifier" class="btn btn-info">
        <a href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>" class="btn btn-danger">Annuler</a>
      </div>    
    </form>
  </div>
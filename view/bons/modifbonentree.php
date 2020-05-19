<?php require VIEW . 'infos/notifications.php'; ?>
<h2>Modifier le bon d'entrée</h2>
<div class="container"> 
    <form method="post" action="/gestock/bonsentree/traitement-bonentree">

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="reference">Numéro du bon d'entrée</label>
            <input type="text" name="reference" id="reference" class="form-control form-control-sm" value="<?= $bonentree->reference ?>">
          </div>
        </div>
        
        <div class="col">
          <div class="form-group">
            <label for="numeroFacture">Numéro de la facture</label>
            <input type="text" name="numeroFacture" id="numeroFacture" class="form-control form-control-sm" value="<?= $bonentree->numeroFacture ?>">
          </div>
        </div>
        
        <div class="col">
          <div class="form-group">
            <label for="dateFacture">Date de la facture</label>
            <input type="date" name="dateFacture" id="dateFacture" class="form-control form-control-sm" value="<?= $bonentree->formatDateEng($bonentree->dateFacture) ?>">
          </div>
        </div>
        
        <div class="col">
          <div class="form-group">
            <label for="fournisseur">Fournisseur</label>
            <select name="fournisseur" id="fournisseur" class="form-control form-control-sm">
              <option value="null">Choisir un fournisseur</option>
              <?php foreach ($fournisseurs as $fournisseur) : ?>
              <option value="<?= $fournisseur->id ?>" <?php if ($fournisseur->id == $bonentree->idFournisseur){echo 'selected="selected"' ;} ?>><?= $fournisseur->nom ?></option>
              <?php endforeach ; ?>
            </select>
          </div>
        </div>
      
      </div>
      

      <?php 
      $i = 1;
      foreach ($bonentree->dotations as $dotation) : ?>
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
              <input type="number" name="quantite<?= $i ?>" id="quantite<?= $i ?>" value="<?= $dotation->quantite ?>" class="form-control form-control-sm" placeholder="Quantité de l'article">
            </div>
          </div>
        
          <div class="col">
            <div class="form-group">
              <label for="prix<?= $i ?>">Prix unitaire</label>
              <input type="number" name="prix<?= $i ?>" id="prix<?= $i ?>" value="<?= $dotation->prix ?>" class="form-control form-control-sm" placeholder="Saisir le prix unitaire de l'article">
            </div>
          </div>
        
          <div class="col">
            <div class="form-group">
              <label for="total<?= $i ?>">Total</label>
              <input type="text" name="total<?= $i ?>" id="total<?= $i ?>" value="<?= $dotation->total ?>" class="form-control form-control-sm" disabled>
            </div>
          </div>
        <!-- fin row -->
        </div> 

      <?php 
      $i++;
      endforeach ; ?>

      <?php if ($i < 10){
        for ($i = $i ; $i <= 10; $i ++) : ?>
          <div class="row row-color">

            <div class="col-sm-3">
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

            <div class="col-sm-3">
              <div class="form-group">
                <label for="quantite<?= $i ?>">Quantité</label>
                <input type="number" name="quantite<?= $i ?>" id="quantite<?= $i ?>" class="form-control form-control-sm" placeholder="Saisir un nombre">
              </div>
            </div>
          
            <div class="col-sm-3">
              <div class="form-group">
                <label for="prix<?= $i ?>">Prix unitaire</label>
                <input type="number" name="prix<?= $i ?>" id="prix<?= $i ?>" class="form-control form-control-sm" placeholder="Saisir le prix unitaire">
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                <label for="total<?= $i ?>">Total</label>
                <input type="text" name="total<?= $i ?>" id="total<?= $i ?>" class="form-control form-control-sm" value="0" disabled>
              </div>
            </div>

        </div> 
        <?php endfor ;
      }
      ?>

      <div class="row zonegrise">
        <div class="col-sm-8">
          <p>Total général</p>
        </div>
        <div class="col-sm-4 text-right">
          <p class="totalgeneral" id="totalGeneral"><?= $bonentree->totalGeneral ?></p>
        </div>
      </div> 
      
      <input type="hidden" name="operation" value="modifier">
      <input type="hidden" name="id" value="<?= $bonentree->id ?>">
      
      <div class="mt-5">
        <input type="submit" value="Modifier" class="btn btn-info">
        <a href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>" class="btn btn-danger">Annuler</a>
      </div>    
    </form>
  </div>
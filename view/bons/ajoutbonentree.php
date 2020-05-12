<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Ajouter un bon d'entrée</h2>
<div> 
  <form method="post" action="/gestock/bonsentree/traitement-bonentree">
    <div class="row">
    
      <div class="col">
        <div class="form-group">
          <label for="reference">Numéro du bon d'entrée</label>
          <input type="text" name="reference" id="reference" class="form-control" placeholder="Numéro du bon d'entrée" required>
        </div>
      </div>
      
      <div class="col">
        <div class="form-group">
          <label for="numeroFacture">Numéro de la facture</label>
          <input type="text" name="numeroFacture" id="numeroFacture" class="form-control" placeholder="Numéro de la facture">
        </div>
      </div>
      
      <div class="col">
        <div class="form-group">
          <label for="dateFacture">Date de la facture</label>
          <input type="date" name="dateFacture" id="dateFacture" class="form-control" placeholder="Date de la facture">
        </div>
      </div>
      
      <div class="col">
        <div class="form-group">
          <label for="fournisseur">Fournisseur</label>
          <select name="fournisseur" id="fournisseur" class="form-control">
            <option value="null">Choisir un fournisseur</option>
            <?php foreach ($fournisseurs as $fournisseur) : ?>
            <option value="<?= $fournisseur->id ?>"><?= $fournisseur->nom ?></option>
            <?php endforeach ; ?>
          </select>
        </div>
      </div>
      
    </div>
    

    <h6>Dotations</h6>
    
    <?php for ($i = 1; $i <= 10; $i++) : ?>
    <div class="row row-color m-2">

      <div class="col">
        <div class="form-group">
          <label for="article<?= $i ?>">Article</label>
          <select name="article<?= $i ?>" id="article<?= $i ?>" class="form-control">
            <option value="null">Choisir un article</option>
            <?php foreach ($articles as $article) : ?>
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
          <input type="number" name="prix<?= $i ?>" id="prix<?= $i ?>" class="form-control" placeholder="Saisir le prix unitaire" class="text-center font-weight-bold">
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="total<?= $i ?>">Prix total</label>
          <input type="text" name="total<?= $i ?>" id="total<?= $i ?>" class="form-control" value="0" disabled="disabled">
        </div>
      </div>
      
    </div>
    <?php endfor ; ?>

    <div class="row zonegrise">
      <div class="col-sm-8">
        <p>Total général</p>
      </div>
      <div class="col-sm-4 text-right">
        <p class="totalgeneral" id="totalGeneral">0</p>
      </div>
    </div> 
    
    <div class="mt-5">
      <input type="hidden" name="operation" value="ajouter">
      <input type="submit" value="Ajouter" class="btn btn-success">
      <a href="/gestock/bonsentree/liste" class="btn btn-danger">Annuler</a>    
    </div>
  </form>
</div>
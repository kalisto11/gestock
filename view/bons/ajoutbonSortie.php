<?php require VIEW . 'infos/notifications.php'; ?>

<h2>Ajouter un bon de sortie</h2>
<div class="container"> 
  <form method="post" action="/gestock/bonssortie/traitement-bonsortie">
    
    <div class="form-group">
      <label for="reference">Référence</label>
      <input type="text" name="reference" id="reference" class="form-control form-control-sm" placeholder="référence du bon de sortie"  <?php if (isset($bonsortie)) : ?> value="<?= $bonsortie->reference ?>" <?php endif ; ?> required>
    </div>

    <div class="form-group mt-3">
      <label for="beneficiaire">Bénéficiaire</label>
      <select name="beneficiaire" id="beneficiaire" class="form-control form-control-sm">
        <option value="null">Choisir un bénéficiare</option>
        <?php foreach($personnels as $personnel): ?>
        <option value="<?= $personnel->id ?>" <?php if (isset($bonsortie) AND $bonsortie->beneficiaire == $personnel->id){echo 'selected="selected"' ;} ?>>  <?= $personnel->prenom?>  <?= $personnel->nom ?></option>
        <?php endforeach ; ?>
      </select>
    </div>

    <h6>Dotations</h6>
    <div id="dotations">
        <div class="row row-color m-2">

          <div class="col-3">
            <div class="form-group">
              <label for="article1">Article</label> 
              <select name="article1" id="article1" class="form-control form-control-sm">
                <option value="null">Choisir un article</option>
                <?php foreach($articles as $article): ?>
                <option value="<?= $article->id ?>"><?= $article->nom ?></option>
                <?php endforeach ; ?>
              </select> 
            </div> 
          </div>

          <div class="col-3">
            <div class="form-group">
              <label for="quantite1">Quantité</label>
              <input type="number" name="quantite1" id="quantite1" class="form-control form-control-sm" placeholder="Saisir un nombre">
            </div>
          </div>
          
          <div class="col-3">
            <div class="form-group">
              <label for="prix1">Prix unitaire</label>
              <input type="number" name="prix1" id="prix1" class="form-control form-control-sm">
            </div>
          </div>

          <div class="col-2">
            <div class="form-group">
              <label for="total1">Prix total</label>
              <input type="text" name="total1" id="total1" class="form-control form-control-sm totalArticle" value="0" disabled>
            </div>
          </div>

          <div class="col-1 d-flex align-items-center">
            <button type="button" class="btn btn-sm btnSuppr"><img src="images/icones/delete.png" alt="" class="menu-icone" title="Supprimer l'article"></button>
          </div>

        </div> 
    </div>

    <input type="hidden" name="operation" value="ajouter">

    <div class="my-3 text-right">
        <button type="button" class="btn btn-sm btn-info" id="btnAdd">Ajouter un article</button>
    </div>

    <div class="row zonegrise w-25">
      <div class="col-sm-8 text-left">
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
<script src="js/bons.js"></script>
<?php require VIEW . 'infos/notifications.php'; ?>
<h2 class ="article">Modification du bon d'entrée</h2>
<div> 
  <form method="post" action="/gestock/bonsentree/traitement-bonentree">
    <div class="form-group">
      <label for="reference">Référence</label>
      <input type="text" name="reference" id="reference" class="form-control" value="<?= $bonEntree->reference ?>">
    </div>
    <?php for ($i = 0; $i < 10; $i++) : ?>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="article">Article</label>
          <select name="article<?= $i + 1 ?>" id="article" class="form-control">
            <option value="null">----------------------------------</option>
            <?php foreach ($articles as $article) : ?>
            <option value="<?= $article->id ?>"><?= $article->nom ?></option>
            <?php endforeach ; ?>
          </select>
        </div>
      </div>
      <div class="col">
        <label for="quantite">Quantité</label>
        <input type="number" name="quantite<?+ $i + 1 ?>" id="quantite" class="form-control">
      </div>
    </div>
    <?php endfor ; ?>
    <div class="form-group">
      <label for="fournisseur">Fournisseur</label>
      <input type="text" name="fournisseur" id="fournisseur" class="form-control" value="<?= $bonEntree->fournisseur ?>">
    </div>

    <input type="hidden" name="operation" value="modifier">
    <input type="hidden" name="id" value="<?= $bonEntree->id ?>">

    <input type="submit" value="Modifier" class="btn btn-info">
    <a href="/gestock/bonsentree/liste" class="btn btn-danger">Annuler</a>    
  </form>
</div>
<?php require VIEW . 'infos/notifications.php'; ?>
<h2 class="text-center">Ajouter un bon d'entree</h2>
<div> 
  <form method="post" action="/gestock/bonsentree/traitement-bonentree">
    <div class="form-group">
      <label for="reference">Référence</label>
      <input type="text" name="reference" id="reference" class="form-control">
    </div>
    <?php for ($i = 1; $i <= 10; $i++) : ?>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="article">Article</label>
          <select name="article<?= $i ?>" id="article<?= $i ?>" class="form-control">
            <option value="null">----------------------------------</option>
            <?php foreach ($articles as $article) : ?>
            <option value="<?= $article->id ?>"><?= $article->nom ?></option>
            <?php endforeach ; ?>
          </select>
        </div>
      </div>
      <div class="col">
        <label for="quantite">Quantité</label>
        <input type="number" name="quantite" id="quantite" class="form-control">
      </div>
    </div>
    <?php endfor ; ?>
       
    <div class="form-group">
      <label for="fournisseur">Fournisseur</label>
      <input type="text" name="fournisseur" id="fournisseur" class="form-control">
    </div>

    <input type="hidden" name="operation" value="ajouter">

    <input type="submit" value="Ajouter" class="btn btn-success">
    <a href="/gestock/bonsentree/liste" class="btn btn-danger">Annuler</a>    
  </form>
</div>
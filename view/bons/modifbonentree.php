<h2>Modification du bon d'entrée</h2>
<div> 
  <form method="post" action="/gestock/bonsentree/traitement-bonentree">
    <div class="form-group">
      <label for="reference">Référence</label>
      <input type="text" name="reference" id="reference" class="form-control" value="<?= $bonEntree->reference ?>">
    </div>

    <div class="form-group">
      <label for="article">Articles</label>
      <select name="article" id="article" class="form-control">
        <option value="null">----------------------------------</option>
        <?php foreach($articles as $article): ?>
        <option value="<?= $article->id ?>" <?php if($bonEntree->article->id == $article->id){echo 'selected="selected"';}?>><?= $article->nom ?></option>
        <?php endforeach ; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="quantite">Quantité</label><br/>
      <input type="number" name="quantite" id="quantite" class="form-control" value="<?= $bonEntree->quantite ?>">
    </div>

    <div class="form-group">
      <label for="fournisseur">Fournisseur</label>
      <input type="text" name="fournisseur" id="fournisseur" class="form-control" value="<?= $bonEntree->fournisseur ?>">
    </div>

    <input type="hidden" name="operation" value="modifier">
    <input type="hidden" name="id" value="<?= $bonEntree->id ?>">

    <input type="submit" value="Ajouter" class="btn btn-success">
    <a href="/gestock/bonsentree/liste" class="btn btn-danger">Annuler</a>    
  </form>
</div>
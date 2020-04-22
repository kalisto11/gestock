<h1 class="article">Ajouter un Bon de Sortie</h1>
<div class="container"> 
    <form method="post" action="#">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control">
      </div>

      <form>
        <div class="row">
          <div class="col">
              <label for="article">Articles</label>
              <select name="article" id="article" class="form-control">
                <option value="null">----------------------------------</option>
                <?php foreach($articles as $article): ?>
                <option value="<?= $article->id ?>"><?= $article->nom ?></option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
      </form>
      <div class="form-group mt-3">
        <label for="fournisseur">Bénéficiaire</label>
        <select name="article" id="article" class="form-control">
                <option value="null">----------------------------------</option>
                <?php foreach($agents as $agent): ?>
                <option value="<?= $agent->id ?>"><?= $agent->nom ?></option>
                <?php endforeach ; ?>
                </select>
      </div>
  
      <input type="hidden" name="operation" value="ajouter">
  
      <input type="submit" value="Ajouter" class="btn btn-success">
      <a href="#" class="btn btn-danger">Annuler</a>    
    </form>
  </div>



<h1 class="article">Ajouter un Bon de Sortie</h1>
<div class="container"> 
    <form method="post" action="/gestock/bonssortie/traitement-bonsortie">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control">
      </div>
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
        <div class="row">
          <div class="col">
              <label for="article">Articles</label>
              <select name="article" id="article" class="form-control">
                <option value="null">----------------------------------</option>
                <?php foreach($articles as $article): ?>
                <option 
                  value="<?= $article->id ?>"><?= $article->nom ?>
              
                </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
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



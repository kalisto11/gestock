<h2>Modification du bon de sortie</h2>
<div class="container" >
    <form methode="post" action="/gestock/bonssortie/traitement-bonsortie">
    <div class="form-group" >
        <label for="reference">reference :</label>
        <input type="text" name="reference" id="reference" class="form-control" value= "<?= $bonsortie->reference ?>">
    </div>
    <div class="row">
      <div class="col">
        <label for="article">Article 1</label>
        <select name="article1" id="article1" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
        </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 2</label>
        <select name="article2" id="article2" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
          </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 3</label>
        <select name="article3" id="article3" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
          </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 4</label>
        <select name="article4" id="article4" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
          </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 5</label>
        <select name="article5" id="article5" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
          </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 6</label>
        <select name="article6" id="article6" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
          </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 7</label>
        <select name="article7" id="article7" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
          </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 8</label>
        <select name="article8" id="article8" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
          </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 9</label>
        <select name="article9" id="article9" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
        </select>
      </div>
      <div class="row">
      <div class="col">
        <label for="article">Article 10</label>
        <select name="article10" id="article10" class="form-control" value="<?= htmlspecialchars($article->nom) ?>">
          <?php foreach($articles as $article): ?>
            <option value="<?= $article->id ?>">
              <?= $article->nom ?>
            </option>
          <?php endforeach ; ?>
        </select>
      </div>  
         <input type="hidden" name="operation" value="modifier">
      <input type="submit" value="Modifier" class="btn btn-success">
      <a href="/gestock/bonssortie/liste" class="btn btn-danger">Annuler</a>
    </form>  
</div>
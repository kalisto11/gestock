<h1 class="article">Ajouter un Bon de Sortie</h1>
<div class="container"> 
    <form method="post" action="/gestock/bonssortie/traitement-bonsortie">
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control">
      </div>
        <div class="row">
          <div class="col">
              <label for="article1">Article 1</label>
              <select name="article1" id="article1" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[1])){
                      if($article->id == $bonsortie->$article[1]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
         <div class="col">
              <label for="quantite">Quantité 1</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article2">Article 2</label>
              <select name="article2" id="article2" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[2])){
                      if($article->id == $bonsortie->$article[2]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 2</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article3">Article 3</label>
              <select name="article3" id="article3" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[3])){
                      if($article->id == $bonsortie->$article[3]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 3</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article4">Article 4</label>
              <select name="article4" id="article4" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[4])){
                      if($article->id == $bonsortie->$article[4]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 4</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article5">Article 5</label>
              <select name="article5" id="article5" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[5])){
                      if($article->id == $bonsortie->$article[5]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 5</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article6">Article 6</label>
              <select name="article6" id="article6" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[6])){
                      if($article->id == $bonsortie->$article[6]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 6</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article7">Article 7</label>
              <select name="article7" id="article7" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[7])){
                      if($article->id == $bonsortie->$article[7]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 7</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article8">Article 8</label>
              <select name="article8" id="article8" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[8])){
                      if($article->id == $bonsortie->$article[8]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 8</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article9">Article 9</label>
              <select name="article9" id="article9" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[9])){
                      if($article->id == $bonsortie->$article[9]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 9</label>
              <input type="number" name="quantite" id="quantite" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
              <label for="article10">Article 10</label>
              <select name="article10" id="article10" class="form-control">
                <option value="null">---------------------------</option>
                <?php foreach($articles as $article): ?>
                  <option value="<?= $article->id ?>">
                    <?php if (isset($bonsortie->article[10])){
                      if($article->id == $bonsortie->$article[10]->id){
                        echo 'selected= "selected"';
                      }
                    }
                    ?>
                  <?= $article->nom ?>
                  </option>
                <?php endforeach ; ?>
              </select>
          </div>
          <div class="col">
              <label for="quantite">Quantité 10</label>
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



<h2>Modification du bon de sortie</h2>
<div class="container" >
    <form methode="post" action="/gestock/bonssortie/traitement-bonsortie">
    <div class="form-group" >
        <label for="reference">reference :</label>
        <input type="text" name="reference" id="reference" class="form-control">
    </div>
        
        <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form>   
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <form>
            <div class="row">
              <div class="col">
                  <label for="article">Articles</label>
                  <select name="article" id="article" class="form-control">
                    <option value="null">----------------------------------</option>
                    <?php foreach($articles as $article): ?>
                    <option value="<?= $article->id ?>"<?= $article->nom ?></option>
                    <?php endforeach ; ?>
                  </select>
              </div>
              <div class="col">
                <label for="quantite">Quantités</label>
                <input type="number" name="quantite" id="quantite" class="form-control">
              </div>
            </div>
          </form> 
          <div class="form-group"  >
          <label for="beneficiaire">Bénéficiaire</label>
        <select name="beneficiaire" id="beneficiaire" class="form-control">
            <option value="null">----------------------------------</option>
            <?php foreach($personnels as $personnel): ?>
            <option value="<?= $personnel->id ?>">  <?= $personnel->prenom?>  <?= $personnel->nom ?></option>
            <?php endforeach ; ?>
        </select>
         </div>
    </form>

   <input type="submit" value="modifier" />   
</div>
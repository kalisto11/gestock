<?php require VIEW . 'infos/notifications.php'; ?>
<h2>Modification du bon d'entrée</h2>
<div> 
  <form method="post" action="/gestock/bonsentree/traitement-bonentree">
    <div class="form-group">
      <label for="reference">Référence</label>
      <input type="text" name="reference" id="reference" class="form-control" value="<?= $bonentree->reference ?>">
    </div>

    <div class="form-group">
      <label for="article">Articles</label>
      <select name="article" id="article" class="form-control">
        <option value="null">----------------------------------</option>
        <?php foreach($articles as $article): ?>
        <option value="<?= $article->id ?>" <?php if($bonentree->article->id == $article->id){echo 'selected="selected"';}?>><?= $article->nom ?></option>
        <?php endforeach ; ?>
      </select>
    </div>

    <div class="form-group">
      <label for="quantite">Quantité</label><br/>
      <input type="number" name="quantite" id="quantite" class="form-control" value="<?= $bonentree->quantite ?>">
    </div>

    <div class="form-group">
      <label for="fournisseur">Fournisseur</label>
      <input type="text" name="fournisseur" id="fournisseur" class="form-control" value="<?= $bonentree->fournisseur ?>">
    </div>

    <input type="hidden" name="operation" value="modifier">
    <input type="hidden" name="id" value="<?= $bonentree->id ?>">

    <input type="submit" value="Modifier" class="btn btn-info">
    <a href="/gestock/bonsentree/liste" class="btn btn-danger">Annuler</a>    
  </form>
</div>
ajoutArticle($article1, $article2, $article3,$article4, $article5, 
        $article6, $article7, $article8, $article9, $article10){
            $articles = array();
            if ($article1 != "null"){
                $articles[] = strip_tags($article1);
            }
            if ($article2 != "null"){
                $articles[] = strip_tags($article2);
            }
            if ($article3 != "null"){
                $articles[] = strip_tags ($article3);
            }
            if ($article4 != "null"){
                $articles[] = strip_tags($article4);
            }
            if ($article5 != "null"){
                $articles[] = strip_tags($article5);
            }
            if ($article6 != "null"){
                $articles[] = strip_tags($article6);
            }
            if ($article7 != "null"){
                $articles[] = strip_tags($article7);
            }
            if ($article8 != "null"){
                $articles[] = strip_tags($article8);
            }
            if ($article9 != "null"){
                $articles[] = strip_tags($article9);
            }
            if ($article10 != "null"){
                $articles[] = strip_tags($article10);
            }
            
            return $articles;
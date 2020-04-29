<h1 class="">Informations sur le Bon d'Entrée</h1>
<div class="container"> 
      <div class="form-group">
        <label for="reference">Référence</label>
        <p class="ref" ><?= $bonEntree->reference ?></p>
      </div>
      <div class="form-group mt-3">
        <label for="fournisseur">Fournisseur</label>
        <p class="four"><?= $bonEntree->fournisseur ?></p>      
      </div>
      <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Articles</th>
            <th>Quantités</th>
        </tr>
      
        <tr>
            <td>
                <?php if ($bonEntree->article != null): ?>
                    <?php foreach ($bonEntree->article as $article): ?>
                   <p class="art"><?= htmlspecialchars($article->nom) ?></p>
                    <?php endforeach ; ?>
                    <?php else : ?>
                    <?php echo 'NEANT'; ?>
                <?php endif ; ?>
            </td>
            <td>
            <?php if ($bonEntree->quantite != null): ?>
                    <?php foreach ($bonEntree->quantite as $quantite): ?>
                    <p class="quant"><?= htmlspecialchars($quantite->quantite) ?></p>
                    <?php endforeach ; ?>
                    <?php else : ?>
                    <?php echo 'NEANT'; ?>
                <?php endif ; ?>      
            </td>                
        </tr>
        
    </table>

      <div>
        <a href="/gestock/bonsentree/modifier/<?= $bonEntree->id ?>"class="btn btn-info">Modifier</a>
        <a href="/gestock/bonsentree/supprimer/<?= $bonEntree->id ?>"class="btn btn-danger">Supprimer</a>
    </div>
    </div>
    <div class="mt-5">
        <p>
            <a class="btn btn-warning float-right" href="/gestock/bonsentree/liste">Voir la liste des Bons d'entrée</a>
        </p>
    </div>
</div>


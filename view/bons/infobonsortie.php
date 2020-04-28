<h1 class="article">Informations sur le bon de sortie</h1>
<div class="container"> 
      <div class="form-group">
        <label for="reference">Référence</label>
        <input type="text" name="reference" id="reference" class="form-control" value="<?= $bonsortie->reference ?>" disabled>
      </div>
      <div class="form-group mt-3">
        <label for="beneficiaire">Bénéficiaire</label>
        <input  name="beneficiaire" id="beneficiaire" class="form-control"value=" <?= $bonsortie->beneficiaire->prenom  ?> <?=$bonsortie->beneficiaire->nom ?>" disabled>        
      </div>
      <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Articles</th>
            <th>Quantités</th>
        </tr>
      
        <tr>
            <td>
                <?php if ($bonsortie->dotations != null): ?>
                    <?php foreach ($bonsortie->dotations as $dotation): ?>
                    <input type="" nom= "article" class="form-control"  value= "<?= htmlspecialchars($dotation->article->nom) ?>" disabled>
                    <?php endforeach ; ?>
                <?php else : ?>
                    <?php echo 'NEANT'; ?>
                <?php endif ; ?>
            </td>
            <td>
            <?php if ($bonsortie->dotations != null): ?>
                <?php foreach ($bonsortie->dotations as $dotation): ?>
                <input type="" name= "quantite" class= "form-control" value= "<?= htmlspecialchars($dotation->quantite) ?>" disabled>
                <?php endforeach ; ?>
                <?php else : ?>
                <?php echo 'NEANT'; ?>
            <?php endif ; ?>      
            </td>                
        </tr>
        
    </table>

      <div>
        <a href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"class="btn btn-info">Modifier</a>
        <a href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"class="btn btn-danger">Supprimer</a>
    </div>
    </div>
    <div class="mt-5">
        <p>
            <a class="btn btn-warning float-right" href="/gestock/bonssortie/liste">Voir la liste des Bons de sortie</a>
        </p>
    </div>
</div>


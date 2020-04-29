<h2>Informations sur le bon de sortie</h2>
<div class="container"> 
    <div class="form-group">
        <label for="reference">Référence</label>
        <p class="zonegrise">
        <?= $bonsortie->reference ?>
        </p>
    </div>
    <div class="form-group">
        <label for="reference">Date</label>
        <p class="zonegrise"><?= $bonsortie->date ?></p>
    </div>
    <div class="form-group mt-3">
        <label for="beneficiaire">Bénéficiaire</label>
        <p class="zonegrise"><?= $bonsortie->beneficiaire->prenom  ?> <?=$bonsortie->beneficiaire->nom ?></p>        
    </div>
    <div>
        <label for="">Dotations</label>
        <?php if ($bonsortie->dotations != null): ?>
        <?php foreach ($bonsortie->dotations as $dotation): ?>
        <div class="row">
            <div class="col">
                <div class="form-group">
                <p class="zonegrise"><?= htmlspecialchars($dotation->article->nom) ?></p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <p class="zonegrise"><?= htmlspecialchars($dotation->quantite) ?></p>
                </div>
            </div> 
        </div>
        <?php endforeach ; ?>
        <?php endif ; ?>         
    </div>
    <div class="mt-5">
        <a href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"class="btn btn-info">Modifier</a>
        <a href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"class="btn btn-danger">Supprimer</a>
    </div>
    <div class="mt-5">
        <p>
            <a class="btn btn-warning float-right" href="/gestock/bonssortie/liste">Voir la liste des Bons de sortie</a>
        </p>
    </div>
</div>
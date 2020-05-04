<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Information sur le bon de sortie</h2>
<div class="container"> 
    <div class="row">
        <div class="col">
            <div class="form-group">
                <h5>Référence</h5>
                <p class="zonegrise">
                <?= $bonsortie->reference ?>
                </p>
            </div>
            <div class="form-group">
                <h5>Date</h5>
                <p class="zonegrise"><?= $bonsortie->date ?></p>
            </div>
            <div class="form-group mt-3">
                <h5>Bénéficiaire</h5>
                <p class="zonegrise"><?= $bonsortie->beneficiaire->prenom  ?> <?=$bonsortie->beneficiaire->nom ?></p>        
            </div>
        </div>
        <div class="col">
            <h5>Dotations</h5>
            <?php if ($bonsortie->dotations != null): ?>
            <?php foreach ($bonsortie->dotations as $dotation): ?>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <p class="zonegrise text-right"><?= htmlspecialchars($dotation->article->nom) ?></p>
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
    </div>
    <div class="mt-5">
        <a href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"class="btn btn-info">Modifier</a>
        <a href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"class="btn btn-danger">Supprimer</a>
    </div>
    <div>
        <p>
            <a class="btn btn-warning float-right" href="/gestock/bonssortie/liste">Voir la liste des Bons de sortie</a>
        </p>
    </div>
</div>
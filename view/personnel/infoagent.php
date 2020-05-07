<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="ml-5 text-center">Information sur l'agent</h2>
<div class="container my-2">
    <div class="card">
        <div class="card-header">
            <h3><?= $agent->prenom ?> <?= $agent->nom ?></h3>
        </div>
        <div class="card-body">
            <h3 class="card-title text-dark"> Poste(s): </h3>
                <ul>
                <?php foreach ($agent->poste as $poste): ?>
                    <li><?= $poste->nom ?></li>
                <?php endforeach ; ?>
                </ul>
            
        </div>
        <div>
            <a href="/gestock/personnels/modifier/<?= $agent->id ?>"class="btn btn-info">Modifier</a>
            <a href="/gestock/personnels/supprimer/<?= $agent->id ?>"class="btn btn-danger">Supprimer</a>
        </div>
    </div>
    <div class="mt-5">
        <p>
            <a class="btn btn-secondary float-right" href="/gestock/personnels/liste">Voir la liste du Personnel</a>
        </p>
    </div>
</div>
    

               

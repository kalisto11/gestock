<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="ml-5 text-center">Information sur l'agent</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div>
            <h6>Prénom et nom de l'agent</h6>
            <p class="zonegrise"><?= $agent->prenom ?> <?= $agent->nom ?></p>
            </div>

            <div>
                <h6>Poste(s) de l'agent</h6>
                <ul class="zonegrise">
                    <?php foreach ($agent->poste as $poste): ?>
                    <li class="ml-3"><?= $poste->nom ?></li>
                    <?php endforeach ; ?>
                </ul>
            </div>

            <div>
                <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
                <div class="text-right mt-5">
                    <a href="/gestock/personnels/modifier/<?= $agent->id ?>"class="btn btn-info">Modifier</a>
                    <a href="/gestock/personnels/supprimer/<?= $agent->id ?>"class="btn btn-danger">Supprimer</a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-8"> 
            <h4 class="text-center">Bons attribués à <?= $agent->prenom ?> <?= $agent->nom ?></h4>
            <table class="table table-striped table-borderless table-hover table-sm">
                <thead>
                    <tr>
                        <th class="th-sm" scope="col">Référence</th>
                        <th class="th-sm" scope="col">Date</th>
                        <th class="th-sm" scope="col">Actions</th>
                    </tr>
                </thead>
                <?php foreach($bonssorties as $bonsortie):?>
                    <tr>
                        <td><?= $bonsortie->reference?></td>
                        <td><?=$bonsortie->date?></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon de sortie"></a>
                        </td>
                    </tr>
                <?php endforeach ;?>
            </table>

            <div class="d-flex justify-content-between my-4">
            <?php if ($currentPage > 1):?>
                <a href="/gestock/personnels/consulter/<?= $agent->id ?>/?page=<?= $currentPage - 1 ?>" class="btn btn-primary">Page précédente</a>
            <?php endif ?>
            <?php if ($currentPage < $pages):?>
                <a href="/gestock/personnels/consulter/<?= $agent->id ?>/?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante </a>
            <?php endif ?>
            </div>
        </div>
    </div>

    

    <div class="mt-5">
        <p>
            <a class="btn btn-secondary float-right" href="/gestock/personnels/liste">Voir la liste du Personnel</a>
        </p>
    </div>
</div>
    

               

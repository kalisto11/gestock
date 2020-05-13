<?php require VIEW . 'infos/notifications.php'; ?>

<h2>Information sur le fournisseur</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div>
            <h6>Nom du fournisseur</h6>
            <p class="zonegrise"><?= $fournisseur->nom ?></p>
            </div>

            <div>
                <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
                <div class="text-right mt-5">
                    <a href="/gestock/fournisseurs/modifier/<?= $fournisseur->id ?>"class="btn btn-info">Modifier</a>
                    <a href="/gestock/fournisseurs/supprimer/<?= $fournisseur->id ?>"class="btn btn-danger">Supprimer</a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-8"> 
            <h4 class="text-center">Bons fournis par <?= $fournisseur->nom ?></h4>
            <table class="table table-striped table-borderless table-hover table-sm">
                <thead>
                    <tr>
                        <th class="th-sm" scope="col">Numéro du bon</th>
                        <th class="th-sm" scope="col">Date</th>
                        <th class="th-sm" scope="col">Actions</th>
                    </tr>
                </thead>
                <?php foreach($bonsentrees as $bonentree):?>
                    <tr>
                        <td><?= $bonentree->reference?></td>
                        <td><?=$bonentree->date?></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon d'entrée"></a>
                        </td>
                    </tr>
                <?php endforeach ;?>
            </table>

            <div class="d-flex justify-content-between my-4">
            <?php if ($currentPage > 1):?>
                <a href="/gestock/fournisseurs/consulter/<?= $fournisseur->id ?>/?page=<?= $currentPage - 1 ?>" class="btn btn-primary">Page précédente</a>
            <?php endif ?>
            <?php if ($currentPage < $pages):?>
                <a href="/gestock/fournisseurs/consulter/<?= $fournisseur->id ?>/?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante </a>
            <?php endif ?>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <p>
            <a class="btn btn-secondary float-right" href="/gestock/fournisseurs/liste">Voir la liste des fournisseurs</a>
        </p>
    </div>
</div>
    

               

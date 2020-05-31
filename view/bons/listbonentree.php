<?php require VIEW . 'infos/notifications.php'; ?>

<h2>Bons d'entrée</h2> 
<div>
    <table class="table table-striped table-borderless table-hover table-sm">
        <tr>
            <th class="th-sm">N° du bon</th>
            <th class="th-sm">Date</th>
            <th>Founisseur</th>
            <th class="th-sm">Actions</th>
        </tr>
        <?php if (!empty($bonsentrees)) : ?>
            <?php foreach($bonsentrees as $bonentree):?>
            <tr>
                <td><?= $bonentree->reference?></td>
                <td><?=$bonentree->date?></td>
                <td><a href="/gestock/fournisseurs/consulter/<?=$bonentree->idFournisseur?>" title="Consulter les informations du fournisseur"><?=$bonentree->nomFournisseur?></a></td>
                
                <td> 
                    <a class="btn btn-info btn-sm" href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon d'entrée"></a>
                    <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>
                        <a class="btn btn-info btn-sm" href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>"><img src="images/icones/pencil.png" class=" menu-icone" title="Modifier les informations du bon d'entrée"></a>
                        <a class="btn btn-info btn-sm suppr" href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>"><img src="images/icones/delete.png" class=" menu-icone" title="Supprimer le bon d'entrée"></a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach ;?>
        <?php endif ; ?>
    </table>
    
</div>

<?php if (isset($pagination->currentPage)) : ?>
<div class="text-center m-0">De <?= $pagination->offset + 1 ?> à <?= $pagination->offset + $pagination->perPage ?></div>
<div class="d-flex justify-content-between my-0 mx-4">
	<?php if ($pagination->currentPage > 1):?>
		<a href=" /gestock/bonsentree/liste/?page=<?= $pagination->currentPage - 1 ?>" title="Page précédente"><img src="images/icones/precedent.png" alt="page précédente" class="page-icone"></a>
	<?php endif ?>
    <?php if ($pagination->currentPage < $pagination->pages):?>
		<a href="/gestock/bonsentree/liste/?page=<?= $pagination->currentPage + 1 ?>" class="ml-auto" title="Page suivante"><img src="images/icones/suivant.png" alt="Page suivante" class="page-icone"></a>
	<?php endif ?>
</div>
<?php endif ; ?>


<div class="zonegrise font-weight-bold px-4 w-50">
    <div class="row">
        <div class="col-sm-8 text-left">
            <h5>Total de bons d'entrée : </h5>
        </div>
        <div class="col-sm-4 text-right">
        <h5><?= $count ?></h5>
        </div>
    </div>
</div>

<?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>
    <div class="mt-5">
        <a class="btn btn-success ml-5" href="/gestock/bonsentree/ajouter"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon d'entrée</a>
    </div>
<?php endif; ?>

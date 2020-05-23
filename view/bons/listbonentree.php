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
    </table>
    
</div>

<div class="d-flex justify-content-between my-4">
	<?php if ($currentPage > 1):?>
		<a href=" /gestock/bonsentree/liste/?page=<?= $currentPage - 1 ?>" class="btn btn-info">Page précédente</a>
	<?php endif ?>
    <?php if ($currentPage < $pages):?>
		<a href="/gestock/bonsentree/liste/?page=<?= $currentPage + 1 ?>" class="btn btn-info ml-auto">Page suivante</a>
	<?php endif ?>
</div>

<?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>
    <div class="mt-5">
        <a class="btn btn-success ml-5" href="/gestock/bonsentree/ajouter"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon d'entrée</a>
    </div>
<?php endif; ?>

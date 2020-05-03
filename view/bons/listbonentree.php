<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Bons d'entrée</h2> 
<div>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Référence</th>
            <th>Date</th>
            <th>Founisseur</th>
            <th>Actions</th>
        </tr>
        <?php foreach($bonsentrees as $bonentree):?>
        <tr>
            <td><?= $bonentree->reference?></td>
            <td><?=$bonentree->date?></td>
            <td><?=$bonentree->fournisseur->nom?></td>
            
            <td> 
            <a href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><button class="btn btn-warning"><img src="images/icones/consult.png" class=" menu-icone"></button></a>
                <a href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>"><button class="btn btn-info"><img src="images/icones/pencil.png" class=" menu-icone"></button></a>
                <a href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>"><button class="btn btn-danger"><img src="images/icones/delete.png" class=" menu-icone"></button></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="d-flex justify-content-between my-4">
	<?php if ($currentPage > 1):?>
		<a href=" /gestock/bonsentree/liste/?page=<?= $currentPage - 1 ?>" class="btn btn-primary">Page précédente</a>
	<?php endif ?>
    <?php if ($currentPage < $pages):?>
		<a href="/gestock/bonsentree/liste/?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante </a>
	<?php endif ?>
</div>
<div class="mt-5">
    <a href="/gestock/bonsentree/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon d'entrée</button></a>
</div>


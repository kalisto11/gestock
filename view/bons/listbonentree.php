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
        <?php foreach($bons_entrees as $bon_entree):?>
        <tr>
            <td><a href="/gestock/bonsentree/consulter/<?= $bon_entree->id ?>"><?= $bon_entree->reference?></a></td>
            <td><a href="/gestock/bonsentree/consulter/<?= $bon_entree->id ?>"><?=$bon_entree->date?></a></td>
            <td><a href="/gestock/bonsentree/consulter/<?= $bon_entree->id ?>"><?=$bon_entree->fournisseur?></a></td>
            <td> 
                <a href="/gestock/bonsentree/modifier/<?= $bon_entree->id ?>"><button class="btn btn-info"><img src="images/icones/pencil.png" class=" menu-icone"></button></a>
                <a href="/gestock/bonsentree/supprimer/<?= $bon_entree->id ?>"><button class="btn btn-danger"><img src="images/icones/delete.png" class=" menu-icone"></button></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="/gestock/bonsentree/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon d'entrée</button></a>
</div>


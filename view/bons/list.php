<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Liste des Bons d'entrée</h2> 
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
            <td><a href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><?= $bonentree->reference?></a></td>
            <td><a href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><?=$bonentree->date?></a></td>
            <td><a href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><?=$bonentree->fournisseur?></a></td>
            <td> 
                <a href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>"><button class="btn btn-info"><img src="images/icones/pencil.png" class=" menu-icone"></button></a>
                <a href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>"><button class="btn btn-danger"><img src="images/icones/delete.png" class=" menu-icone"></button></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="/gestock/bonsentree/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon d'entrée</button></a>
</div>

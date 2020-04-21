<h2 class="mt-5 text-center">Bons d'Entrée</h2> 
<div>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Référence</th>
            <th>Date</th>
            <th>Articles</th>
            <th>Quantité</th>
            <th>Founisseur</th>
            <th>Actions</th>
        </tr>
        <?php foreach($bonentrees as $bonentree):?>
        <tr>
            <td><?=$bonentree->reference?></td>
            <td><?=$bonentree->date?></td>
            <td><?=$bonentree->aricle?></td>
            <td><?=$bonentree->quantite?></td>
            <td><?=$bonentree->fournisseur?></td>
            <td> 
                <a href="/gestock/bonsentree/modifier/<?= $bonentree->id ?>"><button class="btn btn-info"><img src="images/icones/pencil.png"></button></a>
                <a href="/gestock/bonsentree/supprimer/<?= $bonentree->id ?>"><button class="btn btn-danger"><img src="images/icones/delete.png"></button></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="/gestock/bonsentree/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png"> Ajouter un Bon d'entrée</button></a>
</div>


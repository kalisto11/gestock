<h2 class="mt-5 text-center">Bons d'entrée</h2> 
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
        <?php foreach($bons_entrees as $bon_entree):?>
        <tr>
            <td><?= $bon_entree->reference?></td>
            <td><?=$bon_entree->date?></td>
            <td><?=$bon_entree->article->nom?></td>
            <td><?=$bon_entree->quantite?></td>
            <td><?=$bon_entree->fournisseur?></td>
            <td> 
                <a href="/gestock/bonsentree/modifier/<?= $bon_entree->id ?>"><button class="btn btn-info"><img src="images/icones/pencil.png"></button></a>
                <a href="/gestock/bonsentree/supprimer/<?= $bon_entree->id ?>"><button class="btn btn-danger"><img src="images/icones/delete.png"></button></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="/gestock/bonsentree/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png"> Ajouter un bon d'entrée</button></a>
</div>


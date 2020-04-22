<h2 class="mt-5 text-center">Liste des Bons de Sorie</h2> 
<div>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Référence</th>
            <th>Date</th>
            <th>Articles</th>
            <th>Quantité</th>
            <th>Bénéficiaire</th>
            <th>Actions</th>
        </tr>
        <?php foreach($bons_sorties as $bon_sortie):?>
        <tr>
            <td><?= $bon_sortie->reference?></td>
            <td><?=$bon_sortie->date?></td>
            <td><?=$bon_sortie->article->nom?></td>
            <td><?=$bon_sortie->quantite?></td>
            <td><?=$bon_sortie->beneficiaire?></td>
            <td> 
                <a href="#"><button class="btn btn-info"><img src="images/icones/pencil.png" class=" menu-icone">Modifier</button></a>
                <a href="#"><button class="btn btn-danger"><img src="images/icones/delete.png" class=" menu-icone">Supprimer</button></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="#"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon de Sortie</button></a>
</div>


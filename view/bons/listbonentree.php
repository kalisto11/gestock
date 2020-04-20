<h2 class="mt-5 text-center">Liste Bons d'Entrée</h2> 
<div>
    <table >
        <tr>
            <th>Référence</th>
            <th>Date</th>
            <th>Articles</th>
            <th>Quantité</th>
            <th>Founisseurs</th>
            <th>Action</th>
        </tr>
        <?php foreach($bonentrees as $bonentree):?>

        <tr>
            <td><?= $bonentree->reference?></td>
            <td><?=$bonentree->date?></td>
            <td><?=$bonentree->aricle?></td>
            <td><?=$bonentree->quantite?></td>
            <td><?=$bonentree->fournisseur?></td>
            <td> 
                 <a href="#"><button class="btn btn-info"><img src="images/icones/pencil.png">Modifier</button></a>
                 <a href="#"><button class="btn btn-danger"><img src="images/icones/delete.png">Supprimer</button></a>
            </td>
                
        
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="#"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png">Ajouter un Bon</button></a>
</div>


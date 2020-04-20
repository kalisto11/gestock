<h2 class="mt-5 text-center">Liste Bons d'Entrée</h2> 
<div>
    <table >
        <tr>
            <th>Référence</th>
            <th>Date</th>
            <th>Articles</th>
            <th>Quantité</th>
            <th>Founisseurs</th>
            <th>Actions</th>
        </tr>
        <?php foreach($bons_entree as $bon_entree):?>

        <tr>
            <td><?= $bons_entee->reference?></td>
            <td><?=$bons_entee->date?></td>
            <td><?=$bons_entee->aricle</td>
            <td><?=$bons_entee->quantite?></td>
            <td><?=$bons_entee->fournisseur?></td>
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

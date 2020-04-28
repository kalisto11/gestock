<?php require VIEW . 'infos/notifications.php'; ?>
<h2 class="mt-5 text-center">Liste des Bons de Sortie</h2> 
<div>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Référence</th>
            <th>Date</th>
            <th>Bénéficiaire</th>
            <th>Actions</th>
        </tr>
        <?php foreach($bonssorties as $bonsortie):?>
        <tr>
            <td><a href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><?= $bonsortie->reference?></a></td>
            <td><a href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><?=$bonsortie->date?></a></td>
            <td><a href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><?=$bonsortie->beneficiaire->prenom?>  <?=$bonsortie->beneficiaire->nom?></a></td>
            <td> 
                <a href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"><button class="btn btn-info"><img src="images/icones/pencil.png" class=" menu-icone">Modifier</button></a>
                <a href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"><button class="btn btn-danger"><img src="images/icones/delete.png" class=" menu-icone">Supprimer</button></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="/gestock/bonssortie/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon de sortie</button></a>
</div>


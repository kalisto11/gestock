<?php require VIEW . 'infos/notifications.php'; ?>
<h2 class="mt-5 text-center">Bons de sortie</h2> 
<div>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th class="th-sm">Référence</th>
            <th class="th-sm">Date</th>
            <th>Bénéficiaire</th>
            <th class="th-sm">Actions</th>
        </tr>
        <?php foreach($bonssorties as $bonsortie):?>
        <tr>
            <td><?= $bonsortie->reference?></td>
            <td><?=$bonsortie->date?></td>
            <td><a href="/gestock/personnels/consulter/<?= $bonsortie->beneficiaire->id ?>"><?=$bonsortie->beneficiaire->prenom?>  <?=$bonsortie->beneficiaire->nom?></a></td>
            <td>
                <a class="btn btn-info btn-sm" href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon de sortie"></a> 
                <a class="btn btn-info btn-sm" href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"><img src="images/icones/pencil.png" class="menu-icone" title="Modifier les informations du bon de sortie"></a>
                <a class="btn btn-info btn-sm" href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"><img src="images/icones/delete.png" class="menu-icone" title="Supprimer le bon de sortie"></a>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>
<div class="mt-5">
    <a href="/gestock/bonssortie/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon de sortie</button></a>
</div>


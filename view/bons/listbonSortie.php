<?php require VIEW . 'infos/notifications.php'; ?>
<h2 class="mt-5 text-center">Bons de sortie</h2> 
<div>
    <table class="table table-striped table-borderless table-hover table-sm">
        <tr>
            <th class="th-sm">Numéro du bon</th>
            <th class="th-sm">Date</th>
            <th>Bénéficiaire</th>
            <th class="th-sm">Actions</th>
        </tr>
        <?php foreach($bonssorties as $bonsortie):?>
        <tr>
            <td><?= $bonsortie->reference?></td>
            <td><?=$bonsortie->date?></td>
            <td><a href="/gestock/personnels/consulter/<?= $bonsortie->idBeneficiaire ?>"><?=$bonsortie->nomBeneficiaire?></a></td>
            <td>
                <a class="btn btn-info btn-sm" href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon de sortie"></a> 
                <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
                    <a class="btn btn-info btn-sm" href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"><img src="images/icones/pencil.png" class="menu-icone" title="Modifier les informations du bon de sortie"></a>
                    <a class="btn btn-info btn-sm suppr" href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"><img src="images/icones/delete.png" class="menu-icone" title="Supprimer le bon de sortie"></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach ;?>
    </table>
</div>

<div class="d-flex justify-content-between my-4">
	<?php if ($currentPage > 1):?>
		<a href=" /gestock/bonssortie/liste/?page=<?= $currentPage - 1 ?>" class="btn btn-primary">Page précédente</a>
	<?php endif ?>
    <?php if ($currentPage < $pages):?>
		<a href="/gestock/bonssortie/liste/?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante </a>
	<?php endif ?>
</div>

<?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
    <div class="mt-5">
        <a class="btn btn-success ml-5" href="/gestock/bonssortie/ajouter"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon de sortie</a>
    </div>
<?php endif; ?>


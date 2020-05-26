<?php require VIEW . 'infos/notifications.php'; ?>
<h2>Bons de sortie</h2> 
<div>
    <table class="table table-striped table-borderless table-hover table-sm">
        <tr>
            <th class="th-sm">N° du bon</th>
            <th class="th-sm">Date</th>
            <th>Bénéficiaire</th>
            <th class="th-sm">Actions</th>
        </tr>
        <?php if (!empty($bonssorties)) : ?>
            <?php foreach($bonssorties as $bonsortie):?>
            <tr>
                <td><?= $bonsortie->reference?></td>
                <td><?=$bonsortie->date?></td>
                <td><a href="/gestock/personnels/consulter/<?= $bonsortie->idBeneficiaire ?>" title="Consulter les informations du bénéficiaire"><?=$bonsortie->nomBeneficiaire?></a></td>
                <td>
                    <a class="btn btn-info btn-sm" href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon de sortie"></a> 
                    <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>
                        <a class="btn btn-info btn-sm" href="/gestock/bonssortie/modifier/<?= $bonsortie->id ?>"><img src="images/icones/pencil.png" class="menu-icone" title="Modifier les informations du bon de sortie"></a>
                        <a class="btn btn-info btn-sm suppr" href="/gestock/bonssortie/supprimer/<?= $bonsortie->id ?>"><img src="images/icones/delete.png" class="menu-icone" title="Supprimer le bon de sortie"></a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach ;?>
        <?php endif ; ?>
    </table>
</div>

<?php if (isset($pagination->currentPage)) : ?>
<div class="text-center m-0">De <?= $pagination->offset + 1 ?> à <?= $pagination->offset + $pagination->perPage ?></div>
<div class="d-flex justify-content-between my-0 mx-4">
	<?php if ($pagination->currentPage > 1):?>
		<a href=" /gestock/bonssortie/liste/?page=<?= $pagination->currentPage - 1 ?>" title="Page précédente"><img src="images/icones/precedent.png" alt="Page précédente" class="page-icone"></a>
	<?php endif ?>
    <?php if ($pagination->currentPage < $pagination->pages):?>
		<a href="/gestock/bonssortie/liste/?page=<?= $pagination->currentPage + 1 ?>" class="ml-auto" title="Page suivante"><img src="images/icones/suivant.png" alt="Page suivante" class="page-icone"></a>
	<?php endif ?>
</div>
<?php endif ; ?>
<div class="zonegrise font-weight-bold px-4 w-50  text-center my-0">
    <div class="row">
        <div class="col-sm-8 text-left">
            <h5>Total de bons de sorties : </h5>
        </div>
        <div class="col-sm-4 text-right">
        <h5><?= $count ?></h5>
        </div>
    </div>
</div>

<?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>
    <div class="mt-5">
        <a class="btn btn-success ml-5" href="/gestock/bonssortie/ajouter"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un bon de sortie</a>
    </div>
<?php endif; ?>


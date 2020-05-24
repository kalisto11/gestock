<h2>Livre journal</h2>
<div class="row">
    <div class="col-lg-5">
		<div class="mb-5 border rounded p-0 m-0">
			<h4 class="text-center">Bons d'entrée du jour</h4>
		
			<table class="table table-striped table-borderless table-hover table-sm p-0 m-0">
				<thead>
				<tr>
					<th class="th-sm" scope="col">Numéro</th>
					<th class="th-sm" scope="col">Date</th>
					<th scope="col">Founisseur</th>
					<th class="th-sm" scope="col">Action</th>
				</tr>
				</thead>
				<?php foreach($bonssentrees as $bonentree):?>
					<tr>
						<td class="align-middle"><?= $bonentree->reference?></td>
						<td class="align-middle"><?=$bonentree->date?></td>
						<td class="align-middle"><a href="/gestock/fournisseurs/consulter/<?=$bonentree->idFournisseur?>" title="Consulter les informations du fournisseur"><?=$bonentree->nomFournisseur?></a></td>					
						<td class="align-middle"> 
							<a class="btn btn-info btn-sm" href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon d'entrée"></a>
						</td>
					</tr>
				<?php endforeach ;?>
			</table>
			<div class="text-right">
				<a class="btn btn-secondary" href="/gestock/bonsentree/liste">Voir la liste de tous les bons d'entrée</a>
			</div>
		</div>
		
		<div class="mt-5 border rounded p-0 m-0">
			<h4 class="text-center">Bons de sortie du jour</h4>
			<table class="table table-striped table-borderless table-hover table-sm p-0 m-0">
				<thead>
					<tr>
						<th class="th-sm" scope="col">Numéro</th>
						<th class="th-sm" scope="col">Date</th>
						<th scope="col">Bénéficiaire</th>
						<th class="th-sm" scope="col">Action</th>
					</tr>
				</thead>
				<?php foreach($bonssorties as $bonsortie):?>
					<tr>
						<td class="align-middle"><?= $bonsortie->reference?></td>
						<td class="align-middle"><?=$bonsortie->date?></td>
						<td class="align-middle"><a href="/gestock/personnels/consulter/<?= $bonsortie->idBeneficiaire ?>" title="Consulter les informations du bénéficiaire"><?=$bonsortie->nomBeneficiaire?></a></td>
						<td class="align-middle">
							<a class="btn btn-info btn-sm" href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon de sortie"></a>
						</td>
					</tr>
				<?php endforeach ;?>
			</table>
			<div class="text-right">
				<a class="btn btn-secondary" href="/gestock/bonssortie/liste">Voir la liste de tous les bons de sortie</a>
			</div>
		</div>

	</div>

	<div class="col-lg-7">

		<div class="mb-5 border rounded p-0 m-0">
			<h4 class="text-center">Somme des opérations du jour</h4>
			<table class="table table-striped table-borderless table-hover table-sm p-0 m-0">
				<thead>
					<tr>
						<th>Article</th>
						<th>Total entrées</th>
						<th>Total sorties</th>
						<th>Total création</th>
						<th>Total modification</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($entreesSorties as $entSort) : ?>
					<tr>
						<td><a href="/gestock/grandlivres/consulter/<?=$entSort['id'] ?>" title="Consulter l'historique de l'article"><?= $entSort['nom'] ?></td>
						<td class="font-weight-bold text-success"><?= $entSort['sommeEntree'] ?></td>
						<td class="font-weight-bold text-danger"><?= $entSort['sommeSortie'] ?></td>
						<td class="font-weight-bold text-success"><?= $entSort['sommeCreation'] ?></td>
						<td class="font-weight-bold text-danger"><?= $entSort['sommeModification'] ?></td>
					</tr>
					<?php endforeach ; ?>
				</tbody>
			</table>
		</div>
		
		
		<div class="mt-5 border rounded p-0 m-0">
			<h4 class="text-center">Opérations du jour</h4>
			<table class="table table-striped table-borderless table-hover table-sm p-0 m-0">
				<thead>
					<tr>
						<th scope="col">Article</th>
						<th class="th-sm" scope="col">N° bon</th>
						<th class="td-sm">Quantité</th>
						<th class="td-sm">Restant</th>
						<th scope="col">Type transaction</th>
						<th class="td-sm">Date transaction</th>
					</tr>
				</thead>
				<?php if (isset($transactions)) : ?>
					<?php foreach($transactions as $transaction):?>
						<tr>
							<td class="align-middle"><a href="/gestock/grandlivres/consulter/<?=$transaction->idArticle?>" title="Consulter l'historique de l'article"><?=$transaction->nomArticle?></a></td>
							<td><?php if ($transaction->typeTrans != "création" AND $transaction->typeTrans != "modification") : ?><a href="/gestock/<?php if ($transaction->typeTrans == "entrée"){echo 'bonsentree';}elseif($transaction->typeTrans == "sortie"){echo 'bonssortie';}?>/consulter/<?=$transaction->idBon?>" title="Consulter le bon"><?php endif ; ?><?=$transaction->numeroBon?><?php if ($transaction->typeTrans != "création" AND $transaction->typeTrans != "modification") : ?></a><?php endif ; ?></td>
							<td class=" align-middle font-weight-bold text-<?php 
								if ($transaction->typeTrans == "entrée"){
								echo "success";
								}
								elseif($transaction->typeTrans == "sortie"){
								echo "danger";
								} 
								else{
								if ($transaction->quantite > 0){
									echo "success";
								}
								elseif ($transaction->quantite < 0){
									echo "danger";
								}
								}
								?>
								">
								<?php 
									if ($transaction->typeTrans == "entrée"){
										echo '+';
									}
									else if ($transaction->typeTrans == "création"){
										echo '+';
									}
									else if ($transaction->typeTrans == "modification"){
										if ($transaction->quantite > 0){
											echo '+';
										}
									}
									echo $transaction->quantite;
								?>
							</td>
							<td class="align-middle"><?=$transaction->quantiteArticle?></td>
							<td class="align-middle"><?=$transaction->typeTrans?></td>
							<td class="align-middle"><?=$transaction->dateTrans?></td>
						</tr>	
					<?php endforeach ;?>
				<?php endif ; ?>
			</table>
		</div>

		<?php if(isset($pagination->currentPage)) : ?>
		<div class="d-flex justify-content-between mt-3">
				<?php if ($pagination->currentPage > 1):?>
					<a href=" /gestock/livrejournals/?page=<?= $pagination->currentPage - 1 ?>" title="Page précédente"><img src="images/icones/precedent.png" alt="Page précédente" class="page-icone"></a>
				<?php endif ?>
				<?php if ($pagination->currentPage < $pagination->pages):?>
					<a href="/gestock/livrejournals/?page=<?= $pagination->currentPage + 1 ?>" class="ml-auto" title="Page suivante"><img src="images/icones/suivant.png" alt="Page suivante" class="page-icone"></a>
				<?php endif ?>
		</div>
		<?php endif ; ?>

	</div>

</div>


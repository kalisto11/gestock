<h2>Livre journal</h2>
<div class="row">
    <div class="col-lg-6">
		<div class="mb-5">
			<h4 class="text-center">Bons d'entrée</h4>
		
			<table class="table table-striped table-borderless table-hover table-sm">
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
						<td class="align-middle"><a href="/gestock/fournisseurs/consulter/<?=$bonentree->idFournisseur?>"><?=$bonentree->nomFournisseur?></a></td>					
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
		
		<div class="mt-5">
			<h4 class="text-center">Bons de sortie</h4>
			<table class="table table-striped table-borderless table-hover table-sm">
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
						<td class="align-middle"><a href="/gestock/personnels/consulter/<?= $bonsortie->idBeneficiaire ?>"><?=$bonsortie->nomBeneficiaire?></a></td>
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

	<div class="col-lg-6">
	<h4 class="text-center">Transactions du jour</h4>
		<table class="table table-striped table-borderless table-hover table-sm">
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
			<?php foreach($transactions as $transaction):?>
				<tr>
					<td class="align-middle"><a href="/gestock/grandlivres/consulter/<?=$transaction->idArticle?>" title="Consulter l'historique de l'article"><?=$transaction->nomArticle?></a></td>
					<td><?php if ($transaction->typeTrans != "création" AND $transaction->typeTrans != "modification") : ?><a href="/gestock/<?php if ($transaction->typeTrans == "entrée"){echo 'bonsentree';}elseif($transaction->typeTrans == "sortie"){echo 'bonssortie';}?>/consulter/<?=$transaction->idArticle?>" title="Consulter le bon"><?php endif ; ?><?=$transaction->numeroBon?><?php if ($transaction->typeTrans != "création" AND $transaction->typeTrans != "modification") : ?></a><?php endif ; ?></td>
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
							else if ($transaction->typeTrans == "sortie"){
								echo '-';
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
		</table>
		<div class="d-flex justify-content-between my-4">
			<?php if ($currentPage > 1):?>
				<a href=" /gestock/livrejournals/?page=<?= $currentPage - 1 ?>" class="btn btn-info">Page précédente</a>
			<?php endif ?>
			<?php if ($currentPage < $pages):?>
				<a href="/gestock/livrejournals/?page=<?= $currentPage + 1 ?>" class="btn btn-info ml-auto">Page suivante </a>
			<?php endif ?>
		</div>
	</div>

</div>


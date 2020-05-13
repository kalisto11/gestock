<h2 class="text-center mt-3 mb-3">Livre journal</h2>
<div class="row">
    <div class="col-md-6">
		<div class="card ">
			<div class="card-header bg-info text-light p-0">
				<h4 class="text-center m-0">Bons d'entrée</h4>
			</div>
			<div class="card-body p-0">
				<table class="table table-striped table-borderless table-hover table-sm m-0">
                    <thead>
					<tr>
						<th class="th-sm" scope="col">Référence</th>
						<th class="th-sm" scope="col">Date</th>
						<th scope="col">Founisseur</th>
						<th class="th-sm" scope="col">Actions</th>
                    </tr>
                    </thead>
					<?php foreach($bonssentrees as $bonentree):?>
						<tr>
							<td><?= $bonentree->reference?></td>
							<td><?=$bonentree->date?></td>
							<td><a href="/gestock/fournisseurs/consulter/<?=$bonentree->idFournisseur?>"><?=$bonentree->nomFournisseur?></a></td>					
							<td> 
								<a class="btn btn-info btn-sm" href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon d'entrée"></a>
							</td>
						</tr>
        			<?php endforeach ;?>
				</table>
			</div>
			<div class="card-footer bg-info p-0">
				<a class="btn btn-secondary float-right" href="/gestock/bonsentree/liste">Voir la liste de tous les bons d'entrée</a>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-header bg-info text-light p-0">
				<h4 class="text-center m-0">Bons de sortie</h4>
			</div>
			<div class="card-body p-0">
				<table class="table table-striped table-borderless table-hover table-sm m-0">
					<thead>
						<tr>
							<th class="th-sm" scope="col">Référence</th>
							<th class="th-sm" scope="col">Date</th>
							<th scope="col">Bénéficiaire</th>
							<th class="th-sm" scope="col">Actions</th>
						</tr>
					</thead>
					<?php foreach($bonssorties as $bonsortie):?>
						<tr>
							<td><?= $bonsortie->reference?></td>
							<td><?=$bonsortie->date?></td>
							<td><a href="/gestock/personnels/consulter/<?= $bonsortie->idBeneficiaire ?>"><?=$bonsortie->nomBeneficiaire?></a></td>
							<td>
								<a class="btn btn-info btn-sm" href="/gestock/bonssortie/consulter/<?= $bonsortie->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon de sortie"></a>
							</td>
						</tr>
					<?php endforeach ;?>
				</table>
			</div>
			<div class="card-footer bg-info p-0">
			<a class="btn btn-secondary float-right" href="/gestock/bonssortie/liste">Voir la liste de tous les bons de sortie</a>
			</div>
		</div>	
	</div>
</div>


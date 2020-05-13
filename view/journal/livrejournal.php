<h2 class="text-center mt-3 mb-3">Livre journal</h2>
<div class="row justify-content-center">
    <div class="col-md-6">
		<div class="card ">
			<div class="card-header bg-info text-light p-0">
				<h3 class="text-center">Bons d'entrée</h3>
			</div>
			<div class="card-body pr-0  pl-0 pt-0 ">
				<table class="table table-striped table-borderless table-hover table-sm" >
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
							<td><?=$bonentree->nomFournisseur?></td>					
							<td> 
								<a class="btn btn-info btn-sm" href="/gestock/bonsentree/consulter/<?= $bonentree->id ?>"><img src="images/icones/consult.png" class="menu-icone" title="Consulter les informations du bon d'entrée"></a>
							</td>
						</tr>
        			<?php endforeach ;?>
				</table>
			</div>
		</div>
        
        </div>

		<div class="col-md-6 ">
			<div class="card">
				<div class="card-header bg-info text-light p-0">
					<h3 class="text-center">Bons de sortie</h3>
					</div>
					<div class="card-body pr-0  pl-0 pt-0">
					<table class="table table-striped table-borderless table-hover table-sm">
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
			</div>
			
	</div>


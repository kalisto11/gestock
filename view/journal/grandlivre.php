<h2>Information inventaire</h2>
	<div class="container my-2">
		<div class="card">
			<div class="card-header">
				<h3 class="text-center"><?= $article->nomarticle ?></h3>
			</div>
        <div class="card-body pl-0 pt-0">
        <table class=" table table-striped table-bordered  table-sm">
          <tr>
            <th>Référence bon d'entrée</th>
            <th>Référence bon de sortie</th>
            <th>Quantité avant</th>
            <th>Quantité aprés</th>
          </tr>
              
            <tr>
              <td><?= htmlspecialchars($inventaire->referencebonentree) ?></td>
              <td><?= htmlspecialchars($dotation->referencebonsortie) ?></td>
              <td><?= htmlspecialchars($dotation->quantiteavant) ?></td>
              <td><?= htmlspecialchars($dotation->quantiteapres) ?></td>
			</tr>
			
		</table>
           

		</div>    
	</div>    
   
	

	<div class="modal-footer mt-3">
        <p>
            <a class="btn btn-secondary" href="#">Voir grand livre</a>
        </p>
    </div>
</div> 

<h2 class="text-center mt-3 mb-3">Historique des transactions</h2>
<div class="container-fluid"> 
  <div class="row">
    <div class="col-sm-3">
   
      <div>
        <h6>Nom Article</h6>  
        <p class="zonegrise" ><?= $article->nom ?></p>
      </div>
      <div>
        <h6>Quantité dans le stock</h6>
        <p class="zonegrise"><?= $article->quantite ?></p>
      </div>
     </div>
        <div class="col-sm-9">
        <table class="table table-striped table-borderless table-hover table-sm">
          <tr>
            <th>Opération</th>
            <th>Numéro Bon</th>
            <th>Quantité </th>
            <th>Date</th>
          </tr>
          <?php if (!empty($transactions)) : ?>
          <?php foreach($transactions as $transaction):?>
            <tr>
              <td><?= htmlspecialchars($transaction['typeTrans']) ?></td>
              
                <?php if ($transaction['typeTrans'] == 'entree'): ?> 
                  <td>
                    <a href="/gestock/bonsentree/consulter/<?= $transaction['idBon'] ?>"><?= htmlspecialchars($transaction['numeroBon']) ?></a></td>

                  <td class="font-weight-bold text-<?php if ($transaction['typeTrans'] == "entree"){echo "success";}else{echo "danger";} ?>"><?= htmlspecialchars('+'. $transaction['quantite'])?></td>
                  <td><?= htmlspecialchars($transaction['dateTrans'])?></td>
          
                  <?php elseif ($transaction['typeTrans'] == 'sortie'): ?>
                  <td><a href="/gestock/bonssortie/consulter/<?= $transaction['idBon'] ?>"><?= htmlspecialchars($transaction['numeroBon']) ?></a></td>
                  <td class="font-weight-bold text-<?php if ($transaction['typeTrans'] == "entree"){echo "success";}else{echo "danger";} ?>"><?= htmlspecialchars('-'. $transaction['quantite'])?></td>
                  <td><?= htmlspecialchars($transaction['dateTrans'])?></td>
                <?php endif ?>
			      </tr>	
          <?php endforeach ?> 
          <?php else : ?> 
        </table>
        <div class="text-center">Cet article n'a pas encore de transactions effectuées.</div>   
        <?php endif ; ?>      
	    </div>
 
</div>    

	<div class="modal-footer mt-3">
    <p>
      <a class="btn btn-secondary" href="/gestock/grandlivres/liste">Voir grand livre</a>
    </p>
  </div>
</div> 

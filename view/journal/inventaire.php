<h2 class="text-center mt-3 mb-3">Historique des transactions</h2>
<div class="container-fluid"> 
  <div class="row">
    <div class="col-sm-3">
      <div>
        <h6>Nom de l'article</h6>  
        <p class="zonegrise" ><?= $article->nom ?></p>
      </div>
      <div>
        <h6>Quantité dans le stock</h6>
        <p class="zonegrise font-weight-bold text-<?php if ($article->quantite >= $article->seuil + 5){echo 'success';}elseif($article->quantite <= $article->seuil + 5 AND $article->quantite >= $article->seuil){echo 'warning';}else{echo 'danger';} ?>"><?= $article->quantite ?></p>
      </div>
    </div>
    <div class="col-sm-9">
      <table class="table table-striped table-borderless table-hover table-sm">
        <tr>
          <th>Opération</th>
          <th>N° bon/Utilisateur</th>
          <th>Quantité </th>
          <th>Date</th>
        </tr>
        <?php if (!empty($transactions)) : ?>
        <?php foreach($transactions as $transaction):?>
          <tr>
            <td><?= htmlspecialchars($transaction['typeTrans']) ?></td>
            <td>
              <a href="/gestock/<?php if ($transaction['typeTrans'] == "entree"){echo 'bonsentree';}elseif($transaction['typeTrans'] == "sortie"){echo 'bonssortie';}else{echo 'home';} ?>/consulter/<?= $transaction['idBon'] ?>"><?= htmlspecialchars($transaction['numeroBon']) ?></a>
            </td>

            <td class="font-weight-bold text-<?php 
                if ($transaction['typeTrans'] == "entree"){
                  echo "success";
                }
                elseif($transaction['typeTrans'] == "sortie"){
                  echo "danger";
                } 
                else{
                  if ($transaction['quantite'] > 0){
                    echo "success";
                  }
                  elseif ($transaction['quantite'] < 0){
                    echo "danger";
                  }
                }
              ?>
              ">
              <?php 
                if ($transaction['typeTrans'] == "entree"){
                  echo '+';
                }
                elseif($transaction['typeTrans'] == "sortie"){
                  echo '-';
                }
                elseif($transaction['typeTrans'] == "modification"){
                  if ($transaction['quantite'] > 0){
                    echo '+';
                  }
                }
                echo $transaction['quantite'];
              ?>
            </td>
            <td>
            <?= $transaction['dateTrans'] ?>
            </td>
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
        <a class="btn btn-secondary" href="/gestock/grandlivres/liste">Voir le grand livre</a>
      </p>
    </div>
  </div> 
</div>

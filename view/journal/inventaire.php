<h2>Historique des opérations</h2>
<div class="container-fluid"> 
  <div class="row">
    <div class="col-sm-3">
      <div>
        <h6>Nom de l'article</h6>  
        <p class="zonegrise"><?= $article->nom ?></p>
      </div>
      <div>
        <h6>Quantité dans le stock</h6>
        <p class="zonegrise font-weight-bold text-md text-<?php if ($article->quantite >= $article->seuil + 2){echo 'success';}elseif($article->quantite <= $article->seuil + 2 AND $article->quantite >= $article->seuil){echo 'warning';}else{echo 'danger';} ?>"><?= $article->quantite ?></p>
      </div>
    </div>
    <div class="col-sm-9">
      <?php if (!empty($transactions)) : ?>
      <table class="table table-striped table-borderless table-hover table-sm">
        <tr>
          <th>Opération</th>
          <th>N° bon/Utilisateur</th>
          <th>Crédit/débit</th>
          <th>Restant</th>
          <th>Date</th>
        </tr>
       
        <?php foreach($transactions as $transaction):?>
          <tr>
            <td><?= htmlspecialchars($transaction->typeTrans) ?></td>
            <td>
              <?php if ($transaction->typeTrans != "modification" AND $transaction->typeTrans != "création") : ?><a href="/gestock/<?php if ($transaction->typeTrans == "entrée"){echo 'bonsentree';}elseif($transaction->typeTrans == "sortie"){echo 'bonssortie';}else{echo 'home';} ?>/consulter/<?= $transaction->idBon ?>"><?php endif ; ?><?= htmlspecialchars($transaction->numeroBon) ?><?php if ($transaction->typeTrans != "modification") : ?></a><?php endif ;?>
            </td>
            <td class="font-weight-bold text-<?php 
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
            <td><?= $transaction->quantiteArticle ?></td>
            <td> 
            <?= $transaction->dateTrans ?>
            </td>
          </tr>	
        <?php endforeach ?> 
      </table>
      <?php else : ?> 
      <div class="text-center">Cet article n'a pas encore de transactions effectuées.</div>   
      <?php endif ; ?> 
        <div class="mt-5 text-right">
          <p>
            <a class="btn btn-secondary" href="/gestock/grandlivres/liste/">Voir le grand livre</a>
          </p>
        </div>     
      </div>
    </div>    
  </div> 
</div>
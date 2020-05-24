
<h2 class="text-center">Grand livre</h2>
    <?php require VIEW . 'infos/notifications.php'; ?>
    <div>
        <table class="table table-striped table-borderless table-hover table-sm">
          <tr>
              <th>Article</th>
              <th>Quantité</th>
              <th class="th-sm">Action</th>
          </tr>
          <?php foreach($articles as $article):?>
              <tr>
                  <td class="align-middle"><a href="/gestock/grandlivres/consulter/<?=$article->id?>" title="Consulter l'historique des opérations"><?= $article->nom ?></a></td>
                  <td class="align-middle"><?= $article->quantite ?></td>
                  <td class="align-middle">
                      <a class="btn btn-info btn-sm" href="/gestock/grandlivres/consulter/<?=$article->id?>">
                          <img src="images/icones/consult.png" class="menu-icone" alt="Consulter" title="Consulter l'historique des opérations">
                      </a>
                    </td>   
              </tr>
              <?php endforeach ;?>
        </table>
    </div>

    <?php if (isset($pagination->currentPage)) : ?>
    <div class="d-flex justify-content-between my-4">
        <?php if ($pagination->currentPage > 1):?>
            <a href="/gestock/grandlivres/liste/?page=<?= $pagination->currentPage - 1 ?>" title="Page précédente"><img src="images/icones/precedent.png" alt="Page précédente" class="page-icone"></a>
        <?php endif ?>
        <?php if ($pagination->currentPage < $pagination->pages):?>
            <a href="/gestock/grandlivres/liste/?page=<?= $pagination->currentPage + 1 ?>" class="ml-auto" title="Page suivante"><img src="images/icones/suivant.png" alt="Page suivante" class="page-icone"></a>
        <?php endif ?>
    </div> 
    <?php endif ; ?>
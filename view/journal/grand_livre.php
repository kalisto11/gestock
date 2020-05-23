
<h2 class="text-center">Grand livre</h2>
      <?php require VIEW . 'infos/notifications.php'; ?>
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
      <div class="d-flex justify-content-between my-4">
	<?php if ($currentPage > 1):?>
		<a href=" /gestock/grandlivres/liste/?page=<?= $currentPage - 1 ?>" class="btn btn-primary">Page précédente</a>
	<?php endif ?>
    <?php if ($currentPage < $pages):?>
		<a href="/gestock/grandlivres/liste/?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante </a>
	<?php endif ?>
</div> 
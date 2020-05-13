<h2 class="text-center">Grand livre</h2>
      <div>
        <table class="table table-striped table-bordered table-hover table-sm">
          <tr>
              <th>Article</th>
              <th>Quantité</th>
              <th class="th-sm">Action</th>
          </tr>
          <?php foreach($articles as $article):?>
              <tr>
                  <td class="align-middle"><?= $article-></td>
                  <td class="align-middle"><?= $article-></td>
                  <td class="align-middle">
                      <a class="btn btn-info btn-sm" href="/gestock/personnels/consulter/<?=$article->id?>">
                          <img src="images/icones/consult.png" class="menu-icone" alt="Consulter" title="Consulter">
                      </a>
                    </td>   
              </tr>
              <?php endforeach ;?>
          </table>
      </div>
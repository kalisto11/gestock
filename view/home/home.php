<?php require VIEW . 'infos/notifications.php'; ?>
<?php require VIEW . 'infos/notifwelcome.php'; ?>
  <section>
      <div class="row">
        <div class="col-lg-3 m-lg-0 mb-sm-5">
          <div class="card">
            <div class="card-header text-center p-0 m-0">
            <h5 class="text-center p-0 m-0">Mon compte</h5>
            </div>
            <div class="card-body p-0"> 
              <p class="mx-0 mt-2 px-3">Prénom : <?= $user->prenom ?></p>
              <p class="mx-0 px-3">Nom : <?= $user->nom?></p>
              <p class="mx-0 px-3">
                Rôle  : 
                <?php 
                  if($_SESSION['user']['niveau'] == 1){
                    echo "Superviseur";
                  }elseif($_SESSION['user']['niveau'] == 2){
                    echo "Gestionnaire";
                  }
                  elseif($_SESSION['user']['niveau'] == 3){
                  echo "Administrateur";
                  }
                ?>
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 m-lg-0 mb-sm-5">
          <div class="card"> 
            <div class="card-header text-center p-0 m-0"">
            <h5 class="text-center p-0 m-0">Articles bientôt  en rupture</h5>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped table-borderless table-hover table-sm m-0">
                  <thead>
                    <tr>
                      <th class="th-sm" scope="col">Nom</th>
                      <th class="th-sm" scope="col">Quantité</th>
                    </tr>
                  </thead>
                  <?php if ($articles != null) : ?>
                    <?php foreach ($articles as $article) : ?>
                      <?php if ($article->quantite <= $article->seuil) : ?>
                        <tr>
                          <td><?= $article->nom ?></td>
                          <td><?= $article->quantite ?></td>
                        </tr>
                      <?php endif ; ?>  
                    <?php endforeach; ?>  
                  <?php endif ;?>
              </table>
            </div> 
          </div>
        </div>

        <div class="col-lg-5 m-lg-0 mb-sm-5">
          <div class="card bg-light">
            <div class="card-header text-center p-0 m-0"">
            <h5 class="text-center p-0 m-0">Utilisateurs</h5>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped table-borderless table-hover table-sm m-0">
                <tr>
                  <th class="th-sm" scope="col">Nom</th>
                  <th class="th-sm" scope="col">Rôle</th>
                <?php if($_SESSION['user']['niveau'] >= ADMINISTRATEUR) : ?><th class ="th-sm" scope ="col">Action</th><?php endif; ?>
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
                  <td><?= $user->prenom .' '.$user->nom ?></td>
                  <td>
                    <?php if($user->niveau == 1) : ?>
                      <p class="card-text"> SUPERVISEUR </p>
                    <?php elseif($user->niveau  == 2) : ?>
                      <p class="card-text"> GESTIONNAIRE </p>
                    <?php elseif($user->niveau  == 3) : ?>
                      <p class="card-text">ADMINISTRATEUR </p>
                  </td> 
                    <?php endif; ?>
                  <?php if($_SESSION['user']['niveau'] >= ADMINISTRATEUR) : ?>
                    <td>
                      <a class="btn btn-info btn-sm" href="/gestock/acces/modifier/<?= $user->id ?>"><img src="images/icones/pencil.png" class="menu-icone" alt="Modifier" title="Modifier"></a>
                      <a class="btn btn-info btn-sm suppr" href="/gestock/acces/supprimer/<?= $user->id ?>"><img src="images/icones/delete.png" class="menu-icone" alt="Supprimer" title="Supprimer"></a>                     
                    </td>
                  <?php endif; ?> 
                </tr>
                <?php endforeach ?>
              </table>
            </div>
            <?php if($_SESSION['user']['niveau'] >= ADMINISTRATEUR) : ?>
            <div class="card-footer m-0 p-0 text-right">
              <a class="btn btn-info" href="/gestock/acces/ajouter"><img src="images/icones/ajout.png" class=" menu-icone">Ajouter un utilisateur</a>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
  </section>

  <section>
    <div class="row mt-5">

      <div class="col-lg-6 m-lg-0 mb-sm-5">
        <div class="card">
          <div class="card-header p-0 m-0"">
            <h5 class="text-center p-0 m-0">Derniers bons d'entrée</h5>
          </div>
          <div class="card-body m-0 p-0">
            <table class="table table-striped table-borderless table-hover table-sm m-0" >
              <thead>
                <tr>
                  <th class="th-sm" scope="col">N° bon</th>
                  <th class="th-sm" scope="col">Date</th>
                  <th class= "th-sm" scope="col">Fournisseur</th>
                </tr>
              </thead>
              <?php foreach ($bonsentrees as $bonentree): ?>
                <tr>   
                  <td><?= $bonentree->reference ?> </td>
                  <td><?= $bonentree->date ?></td>
                  <td><?= $bonentree->nomFournisseur ?></td>
                </tr>
                <?php 
                  $i = 0;
                  if ($i == 5){
                  break;
                }
                ?>
              <?php endforeach; ?>
            </table>
          </div>
        </div>  
      </div> 

      <div class="col-lg-6">
        <div class="card ">
          <div class="card-header p-0 m-0"">
            <h5 class="text-center p-0 m-0">Derniers bons de sortie</h5>
          </div>
          <div class="card-body m-0 p-0">
            <table class="table table-striped table-borderless table-hover table-sm m-0" >
              <thead>
                <tr>
                  <th class="th-sm" scope="col">N° bon</th>
                  <th class="th-sm" scope="col">Date</th>
                  <th class= "th-sm" scope="col">Bénéficiaire</th>
                </tr>
              </thead>
              <?php foreach ($bonssorties as $bonsortie): ?>
                <tr>   
                  <td><?= $bonsortie->reference ?> </td>
                  <td><?= $bonsortie->date ?></td>
                  <td><?= $bonsortie->nomBeneficiaire ?></td>
                </tr>
                <?php 
                  $i = 0;
                  if ($i == 5){
                  break;
                }
                ?>
              <?php endforeach; ?>
            </table>
        </div>
      </div>  
    </div>
  </section>
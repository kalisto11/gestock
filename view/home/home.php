<?php require VIEW . 'infos/notifications.php'; ?>
<?php require VIEW . 'infos/notifwelcome.php'; ?>
 <section>
      <div class="card-columns">
        <div class="col sm-4">
          <div class="card bg-light  mt-5 ml-3" style="max-width: 18rem;" >
            <div class="card-header text-center">Mon compte</div>
            <div class="card-body"> 
              <p class="card-text">Prénom : <?= $user->prenom ?></p>
              <p class="card-text">Nom : <?= $user->nom?></p>
                <?php if($_SESSION['user']['niveau'] == 1) : ?>
                  <p class="card-text">Role : SUPERVISEUR </p>
                <?php elseif($_SESSION['user']['niveau'] == 2) : ?>
                  <p class="card-text">Role : GESTIONNAIRE </p>
                <?php elseif($_SESSION['user']['niveau'] == 3) : ?>
                  <p class="card-text">Role : ADMINISTRATEUR </p>
                <?php endif; ?> 
            </div>
          </div>
        </div>
        <div class="col sm-4">
          <div class="card bg-light mt-5 ml-5" style="max-width: 25rem;" >
            <div class="card-header text-center">Utilisateurs</div>
            <table class="table table-striped table-borderless table-hover table-sm">
              <tr>
                <th class="th-sm" scope="col">Nom</th>
                <th class="th-sm" scope="col">Role</th>
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
        <?php if($_SESSION['user']['niveau'] >= ADMINISTRATEUR) : ?>
          <div class="mt-3 card-footer">
            <a class="btn btn-info ml-5" href="/gestock/acces/ajouter"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un utilisateur</a>
          </div>
        <?php endif; ?>
        </div>
        <div class="col sm-4">
          <div class="card bg-light  mt-5 ml-3 " style="max-width: 20rem;" > 
             <div class="card-header text-center ">Derniers Articles</div>
              <table class="table table-striped table-borderless table-hover table-sm">
                <thead>
                  <tr>
                    <th class="th-sm" scope="col">Nom</th>
                    <th class="th-sm" scope="col">Quantité</th>
                  </tr>
                </thead>
                <?php if ($articles != null AND $article > 5): ?>
                   <?php for ($i = 0; $i < 5 ; $i++): ?>
                    <tr>
                    <?php if($articles[$i]->quantite <= $articles[$i]->seuil + 5): ?>
                      <td><?= $articles[$i]->nom ?></td>
                      <td><?= $articles[$i]->quantite ?></td>
                    <?php endif; ?>
                    </tr>  
                  <?php endfor; ?>  
                <?php endif ;?>
              </table>
          </div>
        </div>
      </div>
    </section>
    <section>
    <div class="row mt-5 pl-0 pr-0">
      <div class="col-md-6">
        <div class="card ">
          <div class="card-header">
            <h3 class="text-center">Bons d'entrée </h3>
          </div>
          <div class="card-body mr-0 ml-0 pl-0 pr-0 pt-0 ">
            <table class="table table-striped table-borderless table-hover table-sm" >
              <thead>
                <tr>
                  <th class="th-sm" scope="col">Référence</th>
                  <th class="th-sm" scope="col">Date</th>
                  <th class= "th-sm" scope="col">Founisseur</th>
                </tr>
              </thead>
              <?php if($bonsentrees != null): ?>

              <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>   
                <td><?= $bonsentrees[$i]->reference ?> </td>
                <td><?= $bonsentrees[$i]->date ?></td>
                <td><?= $bonsentrees[$i]->nomFournisseur ?></td>
              </tr>
              <?php endfor; ?>
              <?php endif ; ?>
          </table>
        </div>
      </div>  
    </div> 
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Bons de sortie </h3>
        </div>
        <div class="card-body mr-0 ml-0 pl-0 pr-0 pt-0">
          <table class="table table-striped table-borderless table-hover table-sm">
            <thead>
              <tr>
                <th class="th-sm" scope="col">Référence</th>
                <th class="th-sm" scope="col">Date</th>
                <th class= "th-sm" scope="col">Bénéficiaire</th> 
              </tr>
            </thead>
            <?php if($bonssorties != null): ?>
            <?php for ($i = 0; $i < 5; $i++): ?>
              <tr>
                  <td><?= $bonssorties[$i]->reference ?></td>
                  <td><?= $bonssorties[$i]->date ?></td>
                  <td><?= $bonssorties[$i]->nomBeneficiaire ?></td>
              </tr>  
            <?php endfor; ?> 
            <?php endif ; ?> 
        </div>
     </div>    
    </div>
  </div>
</section>
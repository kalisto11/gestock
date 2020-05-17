<?php require VIEW . 'infos/notifications.php'; ?>
<?php require VIEW . 'infos/notifwelcome.php'; ?>
 <section>
      <div class="card-columns">
        <div class="col sm-4">
          <div class="card bg-light  mt-5 ml-3" style="max-width: 18rem;" >
            <div class="card-header">Mon compte</div>
            <div class="card-body"> 
              <p class="card-text">Nom : <?= $_SESSION['user']['nomComplet'] ?></p></br>
              <p class="card-text">Role : <?= $_SESSION['user']['username']?></p>
            </div>
          </div>
        </div>
        <div class="col sm-4">
          <div class="card bg-light mt-5 ml-3" style="max-width: 18rem;" >
            <div class="card-header">Utilisateurs</div>
            <table>
              <tr>
                <th class="th-sm" scope="col">Nom</th>
                <th class="th-sm" scope="col">Role</th>
              </tr>
              <?php foreach ($users as $user): ?>
              <tr>
                <td><?= $user->nomComplet ?></td>
                <td><?= $user->username ?></td>  
              </tr>
              <?php endforeach ?>
            </table>
        </div>
        <div class="col sm-4">
          <div class="card bg-light  mt-5 ml-3" style="max-width: 18rem;" > 
             <div class="card-header">Derniers Articles</div>
              
              <table class="table table-striped table-borderless table-hover table-sm">
                <thead>
                  <tr>
                    <th class="th-sm" scope="col">Nom</th>
                  </tr>
                </thead>
                <?php for ($i = 0; $i < 5; $i++): ?>
                  <tr>
                    <td><?= $articles[$i]->nom ?></td>
                  </tr>  
                <?php endfor; ?>  
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
              <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>   
                <td><?= $bonsentrees[$i]->reference ?> </td>
                <td><?= $bonsentrees[$i]->date ?></td>
                <td><?= $bonsentrees[$i]->nomFournisseur ?></td>
              </tr>
              <?php endfor; ?>
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
            <?php for ($i = 0; $i < 5; $i++): ?>
              <tr>
                  <td><?= $bonssorties[$i]->reference ?></td>
                  <td><?= $bonssorties[$i]->date ?></td>
                  <td><?= $bonssorties[$i]->nomBeneficiaire ?></td>
              </tr>  
            <?php endfor; ?>  
          </table>
        </div>
     </div>    
    </div>
  </div>
</section>
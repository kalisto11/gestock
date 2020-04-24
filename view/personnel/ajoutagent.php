<h2 class="text-center mt-5"><?php if (isset($agent)){echo 'Modifier les informations de l\'agent';}else{echo 'Ajouter un nouvel agent';} ?></h2> 
<div class="container mt-2">
   <form method="post" action="/gestock/personnels/traitement-agent" class="form-sm">
      <div class="form-group">
            <label for="prenom">Prénom </label>
         <input class="form-control" type="text" name="prenom" id="prenom" value="<?php if (isset($agent)){echo $agent->prenom ;} ?>">
      </div>
      
      <div class="form-group">
         <label for="nom">Nom</label>
         <input class="form-control" type="text" name="nom" id="nom" value="<?php if (isset($agent)){echo $agent->nom ;} ?>">
      </div>
      <div class="row">
         <!-- debut poste 1 -->
         <div class="col">
            <div class="form-group">
               <label for="poste1">Poste 1</label>
               <select name="poste1" id="poste1" class="form-control">
                  <option value="null">----------</option>
                  <?php foreach ($postes as $poste): ?>
                  <option 
                     value="<?= $poste->id ?>" 
                     <?php
                        if (isset($agent->poste[0])){
                           if($poste->id == $agent->poste[0]->id){
                              echo 'selected="selected"';
                           }
                        }
                     ?>>
                     <?= $poste->nom ?>
                  </option>
                  <?php endforeach ; ?>
               </select> 
            </div>
         </div>
         <!-- fin poste 1 -->
         <!-- debut poste 2 -->
         <div class="col">
            <div class="form-group">
               <label for="poste2">Poste 2</label>
               <select name="poste2" id="poste2" class="form-control">
                  <option value="null">----------</option>
                  <?php foreach ($postes as $poste): ?>
                  <option 
                     value="<?= $poste->id ?>" 
                     <?php
                        if (isset($agent->poste[1])){
                           if($poste->id == $agent->poste[1]->id){
                              echo 'selected="selected"';
                           } 
                        }
                     ?>>
                     <?= $poste->nom ?>
                  </option>
                  <?php endforeach ; ?>
               </select> 
            </div>
         </div> 
         <!-- fin poste 2 -->
         <!-- debut poste 3 -->
         <div class="col">
            <div class="form-group">
               <label for="poste3">Poste 3</label>
               <select name="poste3" id="poste3" class="form-control">
                  <option value="null">----------</option>
                  <?php foreach ($postes as $poste): ?>
                  <option 
                     value="<?= $poste->id ?>" 
                     <?php
                        if (isset($agent->poste[2])){
                           if($poste->id == $agent->poste[2]->id){
                              echo 'selected="selected"';
                           } 
                        }
                     ?>>
                     <?= $poste->nom ?>
                  </option>
                  <?php endforeach ; ?>
               </select> 
            </div>
         </div>
         <!-- fin poste 3 -->
      </div>
     
      <input type="hidden" name="operation" value="<?php if (isset($agent)){echo 'modifier';}else{echo 'ajouter';} ?>">

      <?php if (isset($agent)) : ?>
         <input type="hidden" name="id" value="<?php if (isset($agent)){echo $agent->id;} ?>">
      <?php endif ; ?>

      <input  class="btn btn-success mt-5" type="submit" value="<?php if (isset($agent)){echo 'Modifier';}else{echo 'Ajouter';} ?>" >
      <a class="btn btn-danger mt-5" href="/gestock/personnels/<?php if (isset($agent)){echo 'consulter/' . $agent->id ;}else{echo '/liste';}?>">Annuler</a>
   </form>
</div>    
        
    
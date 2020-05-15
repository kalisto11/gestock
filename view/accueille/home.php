<h2 class="text-center bg-secondary mt-5">Ajout utilisateurs</h2>
    <div class="container bg-lightr justify-content-center align-items-center"> 
        <form class="mt-5">
             <div class="form-group" id="pourcentage1">
               <label for="formGroupExampleInput" class="nomcomplet">Nom complet</label>
               <input type="text" class="form-control" name="username" id="formGroupExampleInput" placeholder="saisie le nom" required>
             </div>
             <div class="form-group" id="pourcentage2">
               <label for="formGroupExampleInput2" class="nomconnexion">Nom de commexion</label>
               <input type="text" class="form-control" name="username" id="formGroupExampleInput2" placeholder="saisie le nom de connexion" required>
             </div>
             <div class="form-group"id="pourcentage3">
               <label for="exampleFormControlSelect1" class="role">Role</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>Choisi un role</option>
                  <option>Administrateur</option>
                  <option>Gestionnaire</option>
                  <option>Superviseur</option>
                </select>
              </div>
              <div class="form-group"id="pourcentage4">
                <label for="exampleInputPassword1" class="motpass">Mot de passe</label>
                <input type="password" class="form-control" name="pasword" id="exampleInputPassword1" required>
              </div>
              <div class="form-group"id="pourcentage5">
                <label for="exampleInputPassword1" class="confpass">Confirmer le mot de passe</label>
                <input type="password" class="form-control" name="pasword" id="exampleInputPassword1" required>
              </div>
              <div class="modal-footer"> 
                <button type="submit" class="btn btn-primary">Valider</button>
              </div> 
        </form>
    </div>



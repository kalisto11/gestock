<?php require VIEW . 'infos/notifications.php'; ?>
<h2>Donner l'accès à un nouvel utilisateur</h2>
<div class="container w-50"> 
    <form method="post" action="/gestock/acces/ajouter/">
        
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control form-control-sm" required>
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control form-control-sm" required>
        </div>

        <div class="form-group">
            <label for="username">Nom de connexion</label>
            <input type="text" name="username" id="username" class="form-control form-control-sm" placeholder="ex: kdiaw" required>
        </div>
     
      
        Rôle  du nouvel utilisateur <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="niveau" id="administrateur" value="3">
            <label class="form-check-label" for="administrateur">
                Administrateur
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="niveau" id="gestionnaire" value="2">
            <label class="form-check-label" for="gestionnaire">
                Gestionnaire
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="niveau" id="superviseur" value="1">
            <label class="form-check-label" for="superviseur">
                Superviseur 
            </label>
        </div>

        <div class="mt-3"></div>

        <div class="form-group">
            <label for="password1">Mot de passe temporaire</label>(l'utilisateur changera son mot de passe à sa première connection).
            <input type="password" name="password1" id="password1" class="form-control form-control-sm" required>
            <img src="images/icones/check.jpg" alt="" class="checkPassword" id="checkPassword1">
            <div id="helpPassword1"></div>
        </div>
        <div id="passwordMsg" class="bg-warning"></div>
        <div class="form-group">
            <label for="password2">Confirmation du mot de passe temporaire</label>
            <input type="password" name="password2" id="password2" class="form-control form-control-sm" required>
            <img src="images/icones/check.jpg" alt="" class="checkPassword" id="checkPassword2">
            <div id="helpPassword2"></div>
        </div>

        <div class="mt-5"></div>

        <input type="submit" value="Valider" class="btn btn-success">
        <a href="/gestock/home/" class="btn btn-danger">Annuler</a>

    </form>
  </div>

<script src="js/form.js"></script>
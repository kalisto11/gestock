<?php require VIEW . 'infos/notifications.php'; ?>
<h2>Modifier les informations d'accès</h2>
<div class="container"> 
    <form method="post" action="/gestock/acces/modifier/">
        <div class="form-group">
            <label for="nomComplet">Prénom et nom</label>
            <input type="text" name="nomComplet" id="nomComplet" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nomComplet">Nom de connexion</label>
            <input type="text" name="nomConnexion" id="nomComplet" class="form-control" required>
        </div>

        Role de l'utilisateur <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="administrateur" value="3" checked>
            <label class="form-check-label" for="administrateur">
                Administrateur
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="gestionnaire" value="2">
            <label class="form-check-label" for="gestionnaire">
                Gestionnaire
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="role" id="superviseur" value="1" checked="checked">
            <label class="form-check-label" for="superviseur">
                Superviseur 
            </label>
        </div>

        <div class="mt-3"></div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="reset">
            <label class="form-check-label" for="reset">Réinitialiser le mot de passe (l'utilisateur changera obligatoirement son mot de passe à sa première connection).</label>
        </div>
        <div id="hiddenBlock">
            <div class="form-group">
                <label for="password1">Nouveau mot de passe temporaire</label>
                <input type="password" name="password1" id="password1" class="form-control">
            </div>

            <div class="form-group">
                <label for="password2">Confirmation du mot de passe temporaire</label>
                <input type="password" name="password2" id="password2" class="form-control">
            </div>
        </div>

        <div class="mt-5"></div>

        <input type="submit" value="valider" class="btn btn-success">
        <a href="/gestock/home/" class="btn btn-danger">Annuler</a>

    </form>
  </div>
  <script src="js/form-acces.js"></script>


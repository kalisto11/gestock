<?php require VIEW . 'infos/notifications.php'; ?>
<h2>Modifier les informations d'accès</h2>
<div class="container w-50"> 
    <form method="post" action="/gestock/acces/modifier/">
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control form-control-sm" value="<?= $user->prenom ?>" required>
        </div>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control form-control-sm" value="<?= $user->nom ?>" required>
        </div>

        <div class="form-group">
            <label for="username">Nom de connexion</label>
            <input type="text" name="username" id="username" class="form-control form-control-sm" value="<?= $user->username ?>" required>
        </div>

        Rôle  de l'utilisateur <br>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="niveau" id="administrateur" value="3" <?php if ($user->niveau == 3){echo 'checked="checked"';} ?>>
            <label class="form-check-label" for="administrateur">
                Administrateur
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="niveau" id="gestionnaire" value="2" <?php if ($user->niveau == 2){echo 'checked="checked"';} ?>>
            <label class="form-check-label" for="gestionnaire">
                Gestionnaire
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="niveau" id="superviseur" value="1" <?php if ($user->niveau == 1){echo 'checked="checked"';} ?>>
            <label class="form-check-label" for="superviseur">
                Superviseur 
            </label>
        </div>

        <div class="mt-3"></div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="reset" name="reset">
            <label class="form-check-label" for="reset">Réinitialiser le mot de passe (l'utilisateur changera obligatoirement son mot de passe à sa première connection).</label>
        </div>
        <div id="hiddenBlock">
            <div class="form-group">
                <label for="password1">Nouveau mot de passe temporaire</label>
                <input type="password" name="password1" id="password1" class="form-control form-control-sm">
                <img src="images/icones/check.jpg" alt="" class="checkPassword" id="checkPassword1">
                <div id="helpPassword1"></div>
            </div>
            <div id="passwordMsg" class="text-danger"></div>
            <div class="form-group">
                <label for="password2">Confirmation du mot de passe temporaire</label>
                <input type="password" name="password2" id="password2" class="form-control form-control-sm">
                <img src="images/icones/check.jpg" alt="" class="checkPassword" id="checkPassword2">
                <div id="helpPassword2"></div>
            </div>
        </div>

        <input type="hidden" name="idUser" value="<?= $user->id ?>">

        <div class="mt-5"></div>

        <input type="submit" value="Valider" class="btn btn-success">
        <a href="/gestock/home/" class="btn btn-danger">Annuler</a>

    </form>
  </div>
  <script src="js/access.js"></script>


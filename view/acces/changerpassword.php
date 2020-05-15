<!doctype html>
<html lang="fr">
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <base href="/gestock/public/">
        <link rel="shortcut icon" type="image/png" href="public/images/icones/favicon.png">
        <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/connexion.css">
         
    </head>
    <body>
      <h2 class="ml-3 mt-3"><img src="images/icones/education.png" class="icone  mr-2">IA KAFFRINE</h2>
      <h1 class="blanc">GESTION DE STOCK</h1>
        <div  class="container bg-lightr justify-content-center align-items-center connexion"> 
          <?php require VIEW . 'infos/notAuth.php'; ?>
          <h2>Changement de mot de passe</h2>
            <div>
                Votre mot de passe actuel est temporaire car d'autres personne le connaisent. Vous devez changer votre mot de passe pour pouvoir se connecter à votre compte de manière sécurisée (aucune autre personne n'y aura accès). <br>
                NB: en cas d'oubli de votre mot de passe, veuillez contacter l'administrateur pour réinitialiser votre compte et vous en donner accès à nouveau.
            </div>
            <div class="container"> 
                <form method="post" action="/gestock/acces/changerpassword/">

                    <div class="form-group">
                        <label for="password1">Nouveau mot de passe</label>
                        <input type="password" name="password1" id="password1" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password2">Confirmation du nouveau mot de passe</label>
                        <input type="password" name="password2" id="password2" class="form-control">
                    </div>

                    <div class="mt-5"></div>

                    <input type="submit" value="valider" class="btn btn-success">
                </form>
            </div>
        </div>
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/propper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>    
    </body>
</html>


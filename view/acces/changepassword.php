<!doctype html>
<html lang="fr">
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <base href="/gestock/public/">
        <link rel="shortcut icon" type="image/png" href="public/images/icones/favicon.png">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/connexion.css">
         
    </head>
    <body>
        <h2 class="ml-3 mt-3"><img src="images/icones/education.png" class="icone  mr-2">IA KAFFRINE</h2>
        <h1 class="blanc">GESTION DE STOCK</h1>
        
        <div  class="text-justify p-4 w-50 container justify-content-center align-items-center connexion"> 
            <h4 class="text-center mb-4">Changement de mot de passe</h4>
            <div class="row">
                <div class="col mr-0">
                    <div>
                        Votre mot de passe actuel est temporaire car d'autres personnes peuvent le connaitre. Vous devez le changer pour pouvoir se connecter à votre compte de manière sécurisée (aucune autre personne n'y aura accès).
                    </div>
                    <div class="mt-4">
                        NB: en cas d'oubli de votre mot de passe, veuillez contacter l'administrateur pour réinitialiser votre compte et vous en donner accès à nouveau.
                    </div>
                </div>
                <div class="col ml-0">
                    <?php require VIEW . 'infos/notAuth.php'; ?>
            
                    <div class="container pb-3 mb-3"> 
                        <form method="post" action="/gestock/acces/changerpassword/">
                            <div class="form-group">
                                <label for="password1"><img src="images/icones/cle.png" class="cle mr-3">Nouveau mot de passe</label>
                                <input type="password" name="password1" id="password1" class="form-control form-control-sm" required>
                                <img src="images/icones/check.jpg" alt="" class="checkPassword" id="checkPassword1">
                                <div id="helpPassword1"></div>
                            </div>
                            <div id="passwordMsg" class="bg-warning"></div>
                            <div class="form-group">
                                <label for="password2"><img src="images/icones/cle.png" class="cle mr-3">Confirmez le mot de passe</label>
                                <input type="password" name="password2" id="password2" class="form-control form-control-sm" required>
                                <img src="images/icones/check.jpg" alt="" class="checkPassword" id="checkPassword2">
                                <div id="helpPassword2"></div>
                            </div>

                            <div class="mt-5"></div>

                            <input type="submit" value="Valider" class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/propper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/form.js"></script>
    </body>
</html>


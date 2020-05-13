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
        <div  class="container bg-lightr justify-content-center align-items-center connexion"> 
          <?php require VIEW . 'infos/notAuth.php'; ?>
            <form class="mt-5" method="post" action="/gestock/auths/" >
              <div class=" form-group">
                <label for="exampleInputEmail1" ><img src="images/icones/user.jpg" class="user mr-3">Nom d'utilisateur</label>
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"><img src="images/icones/cle.png" class="cle mr-3">Mot de passe</label>
                <input type="password" class="form-control" name="pasword" id="exampleInputPassword1" required>
              </div>
              <div class="modal-footer"> 
                <button type="submit" class="btn btn-primary">Se connecter</button>
              </div> 
            </form>
        </div>
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/propper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script> 
    </body>
</html>